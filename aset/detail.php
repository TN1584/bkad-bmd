<?php
// ambil id aset
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = intval($_GET['id']);
$conn = mysqli_connect("localhost", "root", "", "simda_bmd") or die("Koneksi gagal: " . mysqli_connect_error());

// ambil data aset
$sql = "SELECT * FROM aset WHERE id = $id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
    echo "Data tidak ditemukan.";
    exit;
}
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Detail Aset</h2>
    <table class="table table-bordered">
        <tr><th>Kode Aset</th><td><?php echo htmlspecialchars($row['kode']); ?></td></tr>
        <tr><th>Nama Aset</th><td><?php echo htmlspecialchars($row['nama']); ?></td></tr>
        <tr><th>Kategori</th><td><?php echo htmlspecialchars($row['kategori']); ?></td></tr>
        <tr><th>Lokasi</th><td><?php echo htmlspecialchars($row['lokasi']); ?></td></tr>
        <tr><th>Kondisi</th><td><?php echo htmlspecialchars($row['kondisi']); ?></td></tr>
        <tr><th>Nilai Aset</th><td><?php echo number_format($row['nilai'], 0, ',', '.'); ?></td></tr>
        <tr><th>Tahun Perolehan</th><td><?php echo htmlspecialchars($row['tahun_perolehan']); ?></td></tr>
    </table>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
