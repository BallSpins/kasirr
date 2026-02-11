<?php
include '../config/koneksi.php';

$today = date('Y-m-d');
$sql = "SELECT t.id, t.tgl, p.nama AS pelanggan, t.total
        FROM transaksi t
        JOIN pelanggan p ON t.pelanggan_id = p.id
        WHERE DATE(t.tgl) = '$today'
        ORDER BY t.tgl DESC";
$result = mysqli_query($conn, $sql);

$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(total) as total FROM transaksi WHERE DATE(tgl) = '$today'"));
$penghasilan = $data['total'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
  <title>Laporan Pembelian</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-gray-100 min-h-screen flex relative">
  <?php include "../layout/sidebar.php"; ?>
  <div class="flex-1 p-6 relative">
    
    <!-- Header laporan + tombol di kanan -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h2 class="text-2xl font-bold">Laporan Pembelian Hari Ini</h2>
        <p class="text-xl">
          Penghasilan Hari Ini: 
          <span class="text-green-600 font-bold">Rp<?= number_format($penghasilan) ?></span>
        </p>
      </div>
      
      <a href="laporan_export_excel.php" 
         class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">
         Download Laporan
      </a>
    </div>

    <!-- Daftar struk -->
    <div class="grid grid-cols-2 gap-6 mt-6">
      <?php while($row = mysqli_fetch_assoc($result)){ ?>
      <div class="bg-white shadow-md rounded p-4">
        <h3 class="text-lg font-bold mb-2">Struk #<?= $row['id'] ?></h3>
        <p><strong>Tanggal:</strong> <?= $row['tgl'] ?></p>
        <p><strong>Pelanggan:</strong> <?= $row['pelanggan'] ?></p>
        <p><strong>Total:</strong> Rp<?= number_format($row['total']) ?></p>
        <a href="laporan_detail.php?id=<?= $row['id'] ?>" 
           class="text-blue-500 hover:underline mt-2 inline-block">Lihat Struk</a>
      </div>
      <?php } ?>
    </div>
  </div>
</body>
</html>