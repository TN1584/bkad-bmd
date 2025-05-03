<?php
$conn = mysqli_connect("localhost", "root", "", "simda_bmd");

$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'Tanah';

$data = mysqli_query($conn, "SELECT * FROM aset WHERE kategori='$kategori'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan KIB - <?= $kategori ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Laporan KIB (<?= $kategori ?>)</h3>
    <a href="?kategori=Tanah" class="btn btn-sm btn-outline-primary">KIB A - Tanah</a>
    <a href="?kategori=Peralatan" class="btn btn-sm btn-outline-primary">KIB B - Peralatan</a>
    <a href="?kategori=Gedung" class="btn btn-sm btn-outline-primary">KIB C - Gedung</a>
    <a href="?kategori=Jalan" class="btn btn-sm btn-outline-primary">KIB D - Jalan</a>
    <a href="?kategori=Kendaraan" class="btn btn-sm btn-outline-primary">KIB E - Kendaraan</a>
    <a href="?kategori=Buku" class="btn btn-sm btn-outline-primary">KIB F - Buku</a>
    <a href="export_kib_excel.php?kategori=<?= $kategori ?>" class="btn btn-success float-end">📥 Ekspor Excel</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Aset</th>
                <th>Lokasi</th>
                <th>Kondisi</th>
                <th>Nilai</th>
                <th>Tahun</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; while($row = mysqli_fetch_assoc($data)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['kode'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['lokasi'] ?></td>
                <td><?= $row['kondisi'] ?></td>
                <td><?= number_format($row['nilai'], 0, ',', '.') ?></td>
                <td><?= $row['tahun_perolehan'] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
