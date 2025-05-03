<?php
$conn = mysqli_connect("localhost", "root", "", "simda_bmd");

$aset = mysqli_query($conn, "SELECT id, nama FROM aset");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aset_id = intval($_POST['aset_id']);
    $jenis = $_POST['jenis'];
    $tanggal = $_POST['tanggal'];
    $lokasi_baru = mysqli_real_escape_string($conn, $_POST['lokasi_baru']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    $sql = "INSERT INTO mutasi (aset_id, jenis, tanggal, lokasi_baru, keterangan)
            VALUES ($aset_id, '$jenis', '$tanggal', '$lokasi_baru', '$keterangan')";
    if (mysqli_query($conn, $sql)) {
        header("Location: mutasi_riwayat.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mutasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Input Mutasi Aset</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Aset</label>
            <select name="aset_id" class="form-select" required>
                <option value="">Pilih Aset</option>
                <?php while ($a = mysqli_fetch_assoc($aset)): ?>
                    <option value="<?= $a['id']; ?>"><?= $a['nama']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Jenis Mutasi</label>
            <select name="jenis" class="form-select" required>
                <option value="">Pilih Jenis</option>
                <option value="Pemindahan">Pemindahan</option>
                <option value="Penghapusan">Penghapusan</option>
                <option value="Hibah">Hibah</option>
                <option value="Pemusnahan">Pemusnahan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Tanggal Mutasi</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Lokasi Baru (jika ada)</label>
            <input type="text" name="lokasi_baru" class="form-control">
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan Mutasi</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
