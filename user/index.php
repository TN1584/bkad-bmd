<?php
include '../auth/cek_login.php';
include '../config/koneksi.php';

// Hanya admin yang boleh akses
if ($_SESSION['user']['role'] != 'admin') {
    echo "Akses ditolak!";
    exit();
}

$users = mysqli_query($conn, "SELECT * FROM users");
?>

<h2>Manajemen Pengguna</h2>
<a href="tambah.php">+ Tambah Pengguna</a>
<table border="1" cellpadding="8">
    <tr>
        <th>Nama</th>
        <th>Username</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>
    <?php while($u = mysqli_fetch_assoc($users)): ?>
    <tr>
        <td><?= $u['nama'] ?></td>
        <td><?= $u['username'] ?></td>
        <td><?= $u['role'] ?></td>
        <td>
            <a href="edit.php?id=<?= $u['id'] ?>">Edit</a> | 
            <a href="hapus.php?id=<?= $u['id'] ?>" onclick="return confirm('Hapus user ini?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<a href="../dashboard.php">Kembali ke Dashboard</a>
