<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "simda_bmd") or die("Koneksi gagal: " . mysqli_connect_error());

// ambil parameter filter dan pencarian
$search = isset($_GET['search']) ? $_GET['search'] : "";
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : "";
$kondisi = isset($_GET['kondisi']) ? $_GET['kondisi'] : "";

// buat kondisi WHERE sesuai filter
$where = array();
if (!empty($search)) {
    $search = mysqli_real_escape_string($conn, $search);
    $where[] = "(kode LIKE '%$search%' OR nama LIKE '%$search%' OR kategori LIKE '%$search%')";
}
if (!empty($kategori)) {
    $kategori = mysqli_real_escape_string($conn, $kategori);
    $where[] = "kategori = '$kategori'";
}
if (!empty($kondisi)) {
    $kondisi = mysqli_real_escape_string($conn, $kondisi);
    $where[] = "kondisi = '$kondisi'";
}
$whereSQL = "";
if (count($where) > 0) {
    $whereSQL = "WHERE " . implode(' AND ', $where);
}

// pagination
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// hitung total data untuk pagination
$resultCount = mysqli_query($conn, "SELECT COUNT(*) as total FROM aset $whereSQL");
$rowCount = mysqli_fetch_assoc($resultCount);
$totalData = $rowCount['total'];
$totalPages = ceil($totalData / $limit);

// ambil data aset
$sql = "SELECT * FROM aset $whereSQL LIMIT $offset, $limit";
$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Aset Tetap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Daftar Aset Tetap</h2>
    <a href="tambah.php" class="btn btn-primary mb-3">Tambah Aset</a>
    <!-- Form pencarian dan filter -->
    <form method="GET" class="row g-3 mb-3">
        <div class="col-md-3">
            <input type="text" name="search" placeholder="Cari nama/kode/kategori..." value="<?php echo htmlspecialchars($search); ?>" class="form-control">
        </div>
        <div class="col-md-3">
            <select name="kategori" class="form-select">
                <option value="">Semua Kategori</option>
                <option value="Tanah" <?php if ($kategori == "Tanah") echo "selected"; ?>>Tanah</option>
                <option value="Gedung" <?php if ($kategori == "Gedung") echo "selected"; ?>>Gedung</option>
                <option value="Kendaraan" <?php if ($kategori == "Kendaraan") echo "selected"; ?>>Kendaraan</option>
                <option value="Peralatan" <?php if ($kategori == "Peralatan") echo "selected"; ?>>Peralatan</option>
                <option value="Lainnya" <?php if ($kategori == "Lainnya") echo "selected"; ?>>Lainnya</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="kondisi" class="form-select">
                <option value="">Semua Kondisi</option>
                <option value="Baik" <?php if ($kondisi == "Baik") echo "selected"; ?>>Baik</option>
                <option value="Rusak Ringan" <?php if ($kondisi == "Rusak Ringan") echo "selected"; ?>>Rusak Ringan</option>
                <option value="Rusak Berat" <?php if ($kondisi == "Rusak Berat") echo "selected"; ?>>Rusak Berat</option>
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-success">Filter</button>
        </div>
    </form>
    <!-- Tabel data aset -->
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Kondisi</th>
                <th>Nilai</th>
                <th>Tahun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($query) > 0): ?>
                <?php $no = $offset + 1; while ($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($row['kode']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['kategori']); ?></td>
                        <td><?php echo htmlspecialchars($row['lokasi']); ?></td>
                        <td><?php echo htmlspecialchars($row['kondisi']); ?></td>
                        <td><?php echo number_format($row['nilai'], 0, ',', '.'); ?></td>
                        <td><?php echo $row['tahun_perolehan']; ?></td>
                        <td>
                            <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Detail</a>
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="9" class="text-center">Tidak ada data.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <!-- Pagination -->
    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): 
                $link = "?page=" . $i;
                if (!empty($search)) $link .= "&search=" . urlencode($search);
                if (!empty($kategori)) $link .= "&kategori=" . urlencode($kategori);
                if (!empty($kondisi)) $link .= "&kondisi=" . urlencode($kondisi);
            ?>
                <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                    <a class="page-link" href="<?php echo $link; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
