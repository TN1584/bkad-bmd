<?php
$conn = mysqli_connect("localhost", "root", "", "simda_bmd");
$aset = mysqli_query($conn, "SELECT id, nama FROM aset");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aset_id = intval($_POST['aset_id']);
    $tanggal = $_POST['tanggal'];
    $kondisi_fisik = $_POST['kondisi_fisik'];
    $sesuai = $_POST['sesuai_sistem'];
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    $sql = "INSERT INTO stock_opname (aset_id, tanggal, kondisi_fisik, sesuai_sistem, keterangan)
            VALUES ($aset_id, '$tanggal', '$kondisi_fisik', '$sesuai', '$keterangan')";
    if (mysqli_query($conn, $sql)) {
        header("Location: opname_riwayat.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Input Stock Opname</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Input Data Stock Opname</h3>
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
            <label>Tanggal Opname</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kondisi Fisik</label>
            <select name="kondisi_fisik" class="form-select" required>
                <option value="Baik">Baik</option>
                <option value="Rusak Ringan">Rusak Ringan</option>
                <option value="Rusak Berat">Rusak Berat</option>
                <option value="Tidak Ada">Tidak Ada</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Kesesuaian Data Sistem</label>
            <select name="sesuai_sistem" class="form-select" required>
                <option value="Ya">Ya</option>
                <option value="Tidak">Tidak</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan Opname</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
