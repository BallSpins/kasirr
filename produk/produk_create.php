<?php
include '../config/koneksi.php';

function generateKodeProduk($conn){
    // Ambil kode terbesar
    $query = "SELECT MAX(kode_produk) as kodeTerbesar FROM produk";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    $kodeTerbesar = $data['kodeTerbesar'];

    // Ambil angka terakhir
    $urutan = $kodeTerbesar ? (int) substr($kodeTerbesar, 3, 3) : 0;
    $urutan++;

    // Generate huruf random
    $huruf = '';
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for ($i = 0; $i < 3; $i++) {
        $huruf .= $characters[rand(0, strlen($characters) - 1)];
    }

    // Gabungkan huruf + angka
    $kodeBaru = $huruf . sprintf("%03s", $urutan);
    return $kodeBaru;
}

if(isset($_POST['simpan'])){
    $kode_produk = generateKodeProduk($conn);
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $query = "INSERT INTO produk (kode_produk, nama, kategori, harga, stok) 
              VALUES ('$kode_produk','$nama','$kategori','$harga','$stok')";
    mysqli_query($conn, $query);
    header("Location: produk_index.php");
}
?>

<form method="POST">
  Nama Produk: <input type="text" name="nama"><br>
  Kategori: 
  <select name="kategori">
    <option value="makanan">Makanan</option>
    <option value="minuman">Minuman</option>
    <option value="cemilan">Cemilan</option>
  </select><br>
  Harga: <input type="number" name="harga"><br>
  Stok: <input type="number" name="stok"><br>
  <button type="submit" name="simpan">Simpan</button>
</form>

<form method="POST">
  Nama Produk: <input type="text" name="nama_produk"><br>
  Harga: <input type="number" name="harga"><br>
  <button type="submit" name="simpan">Simpan</button>
</form>
<!DOCTYPE html>
<html>
<head>
  <title>Tambah Produk</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-gray-100 min-h-screen flex">
  <?php include "../layout/sidebar.php"; ?>
  <div class="flex-1 p-6">
    <h2 class="text-2xl font-bold mb-6">Tambah Produk</h2>
    <form method="post" class="bg-white shadow-md rounded p-6 w-96">
      <div class="mb-4">
        <label class="block mb-2 font-semibold">Nama</label>
        <input type="text" name="nama" required class="border rounded w-full py-2 px-3">
      </div>
      <div class="mb-4">
        <label class="block mb-2 font-semibold">Kategori</label>
        <select name="kategori" class="border rounded w-full py-2 px-3">
          <option value="makanan">Makanan</option>
          <option value="minuman">Minuman</option>
          <option value="cemilan">Cemilan</option>
        </select>
      </div>
      <div class="mb-4">
        <label class="block mb-2 font-semibold">Harga</label>
        <input type="number" name="harga" required class="border rounded w-full py-2 px-3">
      </div>
      <div class="mb-4">
        <label class="block mb-2 font-semibold">Stok</label>
        <input type="number" name="stok" required class="border rounded w-full py-2 px-3">
      </div>
      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full">Simpan</button>
    </form>
  </div>
</body>
</html>