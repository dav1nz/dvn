<?php
include "koneksi.php";

if (!isset($_SESSION['role']) ||
    $_SESSION['role'] != 'administrator') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>

<h2>Dashboard Administrator</h2>

<h3>Selamat datang <?= htmlspecialchars($_SESSION['nama']) ?></h3>

<a href="barang.php">Data Barang</a>
<br><br>

<a href="pengguna.php">Registrasi Petugas</a>
<br><br>

<a href="laporan.php">Laporan Penjualan</a>
<br><br>

<a href="transaksi.php">Transaksi Penjualan</a>
<br><br>

<a href="logout.php">Logout</a>

</body>
</html>