<?php
include '../config/koneksi.php';
$id = $_GET['id'];

$sql = "SELECT t.id, t.tgl, p.nama AS pelanggan, t.total, t.bayar, t.kembalian
        FROM transaksi t
        JOIN pelanggan p ON t.pelanggan_id = p.id
        WHERE t.id = $id";
$transaksi = mysqli_fetch_assoc(mysqli_query($conn, $sql));

$sqlDetail = "SELECT pr.kode_produk, pr.nama, d.qty, d.subtotal
              FROM transaksi_detail d
              JOIN produk pr ON d.produk_id = pr.id
              WHERE d.transaksi_id = $id";
$resultDetail = mysqli_query($conn, $sqlDetail);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Struk Transaksi</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-gray-100 min-h-screen flex">
  <?php include "../layout/sidebar.php"; ?>
  <div class="flex-1 p-6">
    <div class="bg-white shadow-md rounded p-6 w-96">
      <h2 class="text-xl font-bold mb-4 text-center">Struk #<?= $transaksi['id'] ?></h2>
      <p><strong>Pelanggan:</strong> <?= $transaksi['pelanggan'] ?></p>
      <p><strong>Tanggal:</strong> <?= $transaksi['tgl'] ?></p>
      <hr class="my-4">
      <?php while($d = mysqli_fetch_assoc($resultDetail)){ ?>
        <div class="flex justify-between mb-2">
          <span><?= $d['nama'] ?> (<?= $d['qty'] ?>)</span>
          <span>Rp<?= number_format($d['subtotal']) ?></span>
        </div>
      <?php } ?>
      <hr class="my-4">
      <p><strong>Total:</strong> Rp<?= number_format($transaksi['total']) ?></p>
      <p><strong>Bayar:</strong> Rp<?= number_format($transaksi['bayar']) ?></p>
      <p><strong>Kembalian:</strong> Rp<?= number_format($transaksi['kembalian']) ?></p>
    </div>
  </div>
</body>
</html>