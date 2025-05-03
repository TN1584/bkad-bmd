<?php
session_start();
include 'auth/cek_login.php';
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard SIMDA BMD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.01);
        }
        .navbar {
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }
        footer {
            margin-top: 50px;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4">
        <a class="navbar-brand fw-bold" href="#">BKAD BMD</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="aset/index.php">Manajemen Aset</a></li>
                <li class="nav-item"><a class="nav-link" href="mutasi/mutasi_riwayat.php">Mutasi</a></li>
                <li class="nav-item"><a class="nav-link" href="laporan_kib.php">Laporan</a></li>
                <li class="nav-item"><a class="nav-link" href="user/index.php">Pengguna</a></li>
            </ul>
            <span class="navbar-text text-white me-3">Hai, <?= $user['nama'] ?> (<?= strtoupper($user['role']) ?>)</span>
            <a href="auth/logout.php" class="btn btn-outline-light">Logout</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card p-4">
                    <h4 class="mb-4">📊 Statistik Aset</h4>
                    <canvas id="asetChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <footer>
        &copy; <?= date('Y') ?> SIMDA BMD. Semua Hak Dilindungi.
    </footer>

    <script>
        const ctx = document.getElementById('asetChart').getContext('2d');
        const asetChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Tanah', 'Gedung', 'Kendaraan', 'Peralatan', 'Lainnya'],
                datasets: [{
                    label: 'Jumlah Aset',
                    data: [10, 5, 7, 12, 3], // Ganti dengan data dari database
                    backgroundColor: [
                        '#4e73df',
                        '#1cc88a',
                        '#36b9cc',
                        '#f6c23e',
                        '#e74a3b'
                    ],
                    borderRadius: 10
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Aset'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
