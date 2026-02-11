<?php
include "config/koneksi.php";

// jumlah produk
$jml_produk = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM produk"))['total'];

// jumlah pelanggan
$jml_pelanggan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM pelanggan"))['total'];

// penghasilan hari ini
$today = date('Y-m-d');
$penghasilan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(total) as total FROM transaksi WHERE DATE(tgl) = '$today'"))['total'] ?? 0;

// stok menipis
$stok_menipis = mysqli_query($conn,"SELECT * FROM produk WHERE stok < 3");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body class="bg-gray-100 min-h-screen flex">
  <!-- Sidebar -->
  <div class="w-64 bg-slate-800 text-white min-h-screen p-4">
    <h1 class="text-lg font-bold mb-6">Kasir</h1>
    <ul class="space-y-3">
      <li><a href="./dashboard.php" class="block hover:bg-slate-700 p-2 rounded">Dashboard</a></li>
      <li><a href="./produk/produk_index.php" class="block hover:bg-slate-700 p-2 rounded">Produk</a></li>
      <li><a href="./pelanggan/pelanggan_index.php" class="block hover:bg-slate-700 p-2 rounded">Pelanggan</a></li>
      <li><a href="./transaksi/kasir.php" class="block hover:bg-slate-700 p-2 rounded">Transaksi</a></li>
      <li><a href="./laporan/laporan_pembelian.php" class="block hover:bg-slate-700 p-2 rounded">Laporan</a></li>
      <li><a href="./auth/logout.php" class="block bg-red-600 hover:bg-red-700 p-2 rounded mt-6 text-center">Logout</a></li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="flex-1 p-6">
    <h2 class="text-2xl font-bold mb-6">Dashboard</h2>

    <!-- Jumlah Produk & Pelanggan -->
    <div class="grid grid-cols-2 gap-6 mb-6">
      <div class="bg-white shadow-md rounded p-6">
        <h3 class="text-lg font-semibold">Jumlah Produk</h3>
        <p class="text-3xl font-bold text-blue-600"><?= $jml_produk ?></p>
      </div>
      <div class="bg-white shadow-md rounded p-6">
        <h3 class="text-lg font-semibold">Jumlah Pelanggan</h3>
        <p class="text-3xl font-bold text-green-600"><?= $jml_pelanggan ?></p>
      </div>
    </div>

    <!-- Penghasilan Hari Ini -->
    <div class="bg-white shadow-md rounded p-6 mb-6">
      <h3 class="text-lg font-semibold">Penghasilan Hari Ini</h3>
      <p class="text-3xl font-bold text-purple-600">Rp<?= number_format($penghasilan) ?></p>
    </div>

    <!-- Info Stok -->
    <h3 class="text-xl font-bold mb-4">Info Stok</h3>
    <div class="bg-white shadow-md rounded p-6">
      <?php if(mysqli_num_rows($stok_menipis) > 0){ ?>
        <?php while($p = mysqli_fetch_assoc($stok_menipis)){ ?>
          <div class="flex justify-between mb-2">
            <span><?= $p['nama'] ?></span>
            <span class="text-red-600 font-bold">Stok: <?= $p['stok'] ?> (Hampir habis!)</span>
          </div>
        <?php } ?>
      <?php } else { ?>
        <p class="text-green-600 font-bold">Semua stok aman </p>
      <?php } ?>
    </div>
  </div>
</body>
</html>