<?php
include '../auth/cek_login.php';
include '../config/koneksi.php';


if ($_SESSION['user']['role'] != 'admin') {
    echo "Akses ditolak!";
    exit();
}

if ($_SESSION['user']['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}



if ($_POST) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

    mysqli_query($conn, "INSERT INTO users (nama, username, password, role) VALUES ('$nama','$username','$password','$role')");
    header("Location: index.php");
}
?>

<h2>Tambah Pengguna</h2>

<form method="POST">
    <input type="text" name="nama" placeholder="Nama Lengkap" required><br>
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <select name="role" required>
        <option value="">Pilih Role</option>
        <option value="admin">Admin</option>
        <option value="operator">Operator</option>
        <option value="verifikator">Verifikator</option>
        <option value="pimpinan">Pimpinan</option>
    </select><br>
    <button type="submit">Simpan</button>
</form>
<a href="index.php">Kembali</a>
