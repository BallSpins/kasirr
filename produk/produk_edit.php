<?php
include "../config/koneksi.php";
$id = $_GET['id'];
$p = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM produk WHERE id=$id"));

if($_SERVER['REQUEST_METHOD']=='POST'){
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    mysqli_query($conn,"UPDATE produk SET nama='$nama', kategori='$kategori', harga=$harga, stok=$stok WHERE id=$id");
    header("Location: produk_index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Produk</title>
 <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-[28rem]">
    <h2 class="text-2xl font-bold text-center mb-4">Edit Produk</h2>
    <form method="post">
      <div class="mb-4">
        <label class="block mb-2 font-semibold">Nama Produk</label>
        <input type="text" name="nama" value="<?= $p['nama'] ?>"
          class="border rounded w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <div class="mb-4">
        <label class="block mb-2 font-semibold">Kategori</label>
        <select name="kategori" class="border rounded w-full py-2 px-3">
          <option value="makanan" <?= $p['kategori']=='makanan'?'selected':'' ?>>Makanan</option>
          <option value="minuman" <?= $p['kategori']=='minuman'?'selected':'' ?>>Minuman</option>
          <option value="cemilan" <?= $p['kategori']=='cemilan'?'selected':'' ?>>Cemilan</option>
        </select>
      </div>
      <div class="mb-4">
        <label class="block mb-2 font-semibold">Harga</label>
        <input type="number" name="harga" value="<?= $p['harga'] ?>"
          class="border rounded w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <div class="mb-4">
        <label class="block mb-2 font-semibold">Stok</label>
        <input type="number" name="stok" value="<?= $p['stok'] ?>"
          class="border rounded w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <button type="submit"
        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full">
        Update
      </button>
    </form>
  </div>
</body>
</html>