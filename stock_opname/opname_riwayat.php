<?php
$conn = mysqli_connect("localhost", "root", "", "simda_bmd");
$query = "SELECT o.*, a.nama FROM stock_opname o JOIN aset a ON o.aset_id = a.id ORDER BY o.tanggal DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Stock Opname</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Riwayat Stock Opname</h3>
    <a href="opname_tambah.php" class="btn btn-primary mb-3">Tambah Opname</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Aset</th>
                <th>Tanggal</th>
                <th>Kondisi Fisik</th>
                <th>Data Sistem Sesuai</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['tanggal']; ?></td>
                <td><?= $row['kondisi_fisik']; ?></td>
                <td><?= $row['sesuai_sistem']; ?></td>
                <td><?= $row['keterangan']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
