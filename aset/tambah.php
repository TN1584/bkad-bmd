<?php
// proses tambah data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "simda_bmd") or die("Koneksi gagal: " . mysqli_connect_error());
    $kode = mysqli_real_escape_string($conn, $_POST['kode']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $kondisi = mysqli_real_escape_string($conn, $_POST['kondisi']);
    $nilai = intval($_POST['nilai']);
    $tahun = intval($_POST['tahun']);

    $sql = "INSERT INTO aset (kode, nama, kategori, lokasi, kondisi, nilai, tahun_perolehan) VALUES ('$kode', '$nama', '$kategori', '$lokasi', '$kondisi', $nilai, '$tahun')";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Tambah Data Aset</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label>Kode Aset</label>
            <input type="text" name="kode" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Aset</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori" class="form-select" required>
                <option value="">Pilih Kategori</option>
                <option value="Tanah">Tanah</option>
                <option value="Gedung">Gedung</option>
                <option value="Kendaraan">Kendaraan</option>
                <option value="Peralatan">Peralatan</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kondisi</label>
            <select name="kondisi" class="form-select" required>
                <option value="">Pilih Kondisi</option>
                <option value="Baik">Baik</option>
                <option value="Rusak Ringan">Rusak Ringan</option>
                <option value="Rusak Berat">Rusak Berat</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Nilai Aset</label>
            <input type="number" name="nilai" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tahun Perolehan</label>
            <input type="number" name="tahun" class="form-control" min="1900" max="<?php echo date('Y'); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
