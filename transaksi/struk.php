<?php
include "../config/koneksi.php";
$id = $_GET['id'];

$t = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM transaksi WHERE id=$id"));
$d = mysqli_query($conn,"
    SELECT td.qty, td.subtotal, p.kode_produk, p.nama, p.harga
    FROM transaksi_detail td
    JOIN produk p ON td.produk_id = p.id
    WHERE td.transaksi_id = $id
");
$pelanggan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM pelanggan WHERE id=".$t['pelanggan_id']));
?>
<!DOCTYPE html>
<html>
<head>
  <title>Struk Pembayaran</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body onload="printAndRedirect()" class="bg-white p-6">
  <div class="max-w-md mx-auto">
    <h2 class="text-xl font-bold text-center mb-2">STRUK PEMBAYARAN</h2>
    <hr class="mb-2">
    <?php if($pelanggan){ ?>
      <p class="mb-2">Pelanggan: <?= $pelanggan['nama'] ?> (<?= $pelanggan['no_telp'] ?>)</p>
    <?php } ?>
    <div class="space-y-2 mb-4">
      <?php while($row = mysqli_fetch_assoc($d)) { ?>
        <div class="flex justify-between">
          <span><?= $row['kode_produk'] ?> - <?= $row['nama'] ?> x<?= $row['qty'] ?></span>
          <span>Rp<?= number_format($row['subtotal']) ?></span>
        </div>
      <?php } ?>
    </div>
    <hr class="mb-2">
    <p class="text-right font-bold">Total: Rp<?= number_format($t['total']) ?></p>
    <p class="text-right">Bayar: Rp<?= number_format($t['bayar']) ?></p>
    <p class="text-right">Kembalian: Rp<?= number_format($t['kembalian']) ?></p>
  </div>
  <script>
    function printAndRedirect() {
      window.print();
      setTimeout(function() {
        window.location.href = "kasir.php";
      }, 500);
    }
  </script>
</body>
</html>