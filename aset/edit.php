<?php
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = intval($_GET['id']);
$conn = mysqli_connect("localhost", "root", "", "simda_bmd") or die("Koneksi gagal: " . mysqli_connect_error());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode = mysqli_real_escape_string($conn, $_POST['kode']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $kondisi = mysqli_real_escape_string($conn, $_POST['kondisi']);
    $nilai = intval($_POST['nilai']);
    $tahun = intval($_POST['tahun']);

    $sql = "UPDATE aset SET kode='$kode', nama='$nama', kategori='$kategori', lokasi='$lokasi', kondisi='$kondisi', nilai=$nilai, tahun_perolehan='$tahun' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

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
    <title>Edit Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Data Aset</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Kode Aset</label>
                    <input type="text" name="kode" class="form-control" value="<?php echo htmlspecialchars($row['kode']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Aset</label>
                    <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($row['nama']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Tanah" <?php if ($row['kategori']=="Tanah") echo "selected"; ?>>Tanah</option>
                        <option value="Gedung" <?php if ($row['kategori']=="Gedung") echo "selected"; ?>>Gedung</option>
                        <option value="Kendaraan" <?php if ($row['kategori']=="Kendaraan") echo "selected"; ?>>Kendaraan</option>
                        <option value="Peralatan" <?php if ($row['kategori']=="Peralatan") echo "selected"; ?>>Peralatan</option>
                        <option value="Lainnya" <?php if ($row['kategori']=="Lainnya") echo "selected"; ?>>Lainnya</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" value="<?php echo htmlspecialchars($row['lokasi']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kondisi</label>
                    <select name="kondisi" class="form-select" required>
                        <option value="">Pilih Kondisi</option>
                        <option value="Baik" <?php if ($row['kondisi']=="Baik") echo "selected"; ?>>Baik</option>
                        <option value="Rusak Ringan" <?php if ($row['kondisi']=="Rusak Ringan") echo "selected"; ?>>Rusak Ringan</option>
                        <option value="Rusak Berat" <?php if ($row['kondisi']=="Rusak Berat") echo "selected"; ?>>Rusak Berat</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nilai Aset</label>
                    <input type="number" name="nilai" class="form-control" value="<?php echo htmlspecialchars($row['nilai']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tahun Perolehan</label>
                    <input type="number" name="tahun" class="form-control" value="<?php echo htmlspecialchars($row['tahun_perolehan']); ?>" min="1900" max="<?php echo date('Y'); ?>" required>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-success me-md-2">Update</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
