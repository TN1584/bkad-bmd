<?php
include '../auth/cek_login.php';
include '../config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));


if ($_SESSION['user']['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}



if ($_POST) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $query = "UPDATE users SET nama='$nama', username='$username', role='$role' WHERE id=$id";

    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']);
        $query = "UPDATE users SET nama='$nama', username='$username', password='$password', role='$role' WHERE id=$id";
    }

    mysqli_query($conn, $query);
    header("Location: index.php");
}
?>

<h2>Edit Pengguna</h2>
<form method="POST">
    <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br>
    <input type="text" name="username" value="<?= $data['username'] ?>" required><br>
    <input type="password" name="password" placeholder="Ganti Password (Opsional)"><br>
    <select name="role" required>
        <option value="admin" <?= $data['role']=='admin'?'selected':'' ?>>Admin</option>
        <option value="operator" <?= $data['role']=='operator'?'selected':'' ?>>Operator</option>
        <option value="verifikator" <?= $data['role']=='verifikator'?'selected':'' ?>>Verifikator</option>
        <option value="pimpinan" <?= $data['role']=='pimpinan'?'selected':'' ?>>Pimpinan</option>
    </select><br>
    <button type="submit">Update</button>
</form>
<a href="index.php">Kembali</a>
