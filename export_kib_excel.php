<?php
$conn = mysqli_connect("localhost", "root", "", "simda_bmd");
$kategori = $_GET['kategori'] ?? 'Tanah';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_kib_{$kategori}.xls");

$data = mysqli_query($conn, "SELECT * FROM aset WHERE kategori='$kategori'");
?>

<h3>Laporan KIB <?= $kategori ?></h3>
<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Lokasi</th>
            <th>Kondisi</th>
            <th>Nilai</th>
            <th>Tahun</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; while($row = mysqli_fetch_assoc($data)): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['kode'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['lokasi'] ?></td>
            <td><?= $row['kondisi'] ?></td>
            <td><?= $row['nilai'] ?></td>
            <td><?= $row['tahun_perolehan'] ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
