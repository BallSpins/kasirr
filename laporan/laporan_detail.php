<?php
include '../config/koneksi.php';


$id = $_GET['id'];

// ambil data transaksi + pelanggan
$sql = "SELECT t.id, t.tgl, p.nama AS pelanggan, p.no_telp, t.total, t.bayar, t.kembalian
        FROM transaksi t
        JOIN pelanggan p ON t.pelanggan_id = p.id
        WHERE t.id = '$id'";
$result = mysqli_query($conn, $sql);
$transaksi = mysqli_fetch_assoc($result);

// ambil detail produk
$sqlDetail = "SELECT td.qty, td.subtotal, pr.kode_produk, pr.nama AS produk
              FROM transaksi_detail td
              JOIN produk pr ON td.produk_id = pr.id
              WHERE td.transaksi_id = '$id'";
$resultDetail = mysqli_query($conn, $sqlDetail);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Struk Pembayaran</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-gray-100 min-h-screen flex">
  <!-- Sidebar cukup sekali -->
  <?php include "../layout/sidebar.php"; ?>

  <!-- Konten struk -->
  <div class="flex-1 p-6">
    <div class="max-w-md mx-auto bg-white shadow-md rounded p-6">
      <h2 class="text-xl font-bold text-center mb-2">STRUK PEMBAYARAN</h2>
      <hr class="mb-2">
      <p>Struk #: <?= $transaksi['id'] ?></p>
      <p>Tanggal: <?= $transaksi['tgl'] ?></p>
      <p>Pelanggan: <?= $transaksi['pelanggan'] ?> (<?= $transaksi['no_telp'] ?>)</p>
      <hr class="mb-2">

      <!-- Detail produk per baris -->
      <?php while($row = mysqli_fetch_assoc($resultDetail)){ ?>
        <div class="flex justify-between">
          <span><?= $row['kode_produk'] ?> - <?= $row['produk'] ?> x<?= $row['qty'] ?></span>
          <span>Rp<?= number_format($row['subtotal']) ?></span>
        </div>
      <?php } ?>

      <hr class="mb-2">
      <p class="text-right font-bold">Total: Rp<?= number_format($transaksi['total']) ?></p>
      <p class="text-right">Bayar: Rp<?= number_format($transaksi['bayar']) ?></p>
      <p class="text-right">Kembalian: Rp<?= number_format($transaksi['kembalian']) ?></p>
    </div>
  </div>
</body>
</html>