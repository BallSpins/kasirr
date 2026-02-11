<?php
include "../config/koneksi.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $nama = $_POST['nama'];
  $no_telp = $_POST['no_telp'];

  // simpan ke database
  mysqli_query($conn,"INSERT INTO pelanggan (nama,no_telp) VALUES ('$nama','$no_telp')");
  header("Location: pelanggan_index.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Tambah Pelanggan</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-gray-100 min-h-screen flex">
  <?php include "../layout/sidebar.php"; ?>
  <div class="flex-1 p-6">
    <h2 class="text-2xl font-bold mb-6">Tambah Pelanggan</h2>
    <form action="" method="post" class="bg-white shadow-md rounded p-6 max-w-md">
      <div class="mb-4">
        <label class="block mb-2 font-semibold">Nama</label>
        <input type="text" name="nama" required 
               class="border rounded w-full p-2 focus:ring focus:ring-blue-300">
      </div>
      <div class="mb-4">
        <label class="block mb-2 font-semibold">No Telp</label>
        <input type="text" name="no_telp" required 
               class="border rounded w-full p-2 focus:ring focus:ring-blue-300">
      </div>
      <button type="submit" 
              class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
        Simpan
      </button>
    </form>
  </div>
</body>
</html>