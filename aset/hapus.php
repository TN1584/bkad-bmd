<?php
// proses hapus data
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn = mysqli_connect("localhost", "root", "", "simda_bmd") or die("Koneksi gagal: " . mysqli_connect_error());
    $sql = "DELETE FROM aset WHERE id = $id";
    mysqli_query($conn, $sql);
}
header("Location: index.php");
exit;
?>
