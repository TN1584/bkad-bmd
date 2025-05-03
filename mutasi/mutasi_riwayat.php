<?php
$conn = mysqli_connect("localhost", "root", "", "simda_bmd");
$query = "SELECT m.*, a.nama FROM mutasi m JOIN aset a ON m.aset_id = a.id ORDER BY m.tanggal DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Mutasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Riwayat Mutasi Barang</h3>
    <a href="mutasi_tambah.php" class="btn btn-primary mb-3">Tambah Mutasi</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Aset</th>
                <th>Jenis</th>
                <th>Tanggal</th>
                <th>Lokasi Baru</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['jenis']; ?></td>
                <td><?= $row['tanggal']; ?></td>
                <td><?= $row['lokasi_baru']; ?></td>
                <td><?= $row['keterangan']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
