<?php
include '../config/koneksi.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT * FROM produk WHERE nama LIKE '%$search%' OR kode_produk LIKE '%$search%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Produk</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../sweetalert/sweetalert2.min.css">
  <script src="../sweetalert/sweetalert2.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
  <?php include "../layout/sidebar.php"; ?>
  <div class="flex-1 p-6">
    <h2 class="text-2xl font-bold mb-6">Data Produk</h2>

    <!-- Form Search -->
    <form method="GET" action="" class="mb-4 flex items-center space-x-2">
      <input type="text" name="search" placeholder="Cari produk..."
        value="<?php echo $search; ?>"
        class="border px-3 py-2 rounded w-64 focus:outline-none focus:ring-2 focus:ring-blue-400">
      <button type="submit"
        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
        Cari
      </button>
    </form>

    <a href="produk_create.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Produk</a>

    <div class="bg-white shadow-md rounded overflow-x-auto">
      <table class="min-w-full border-collapse">
        <thead>
          <tr class="bg-gray-200">
            <th class="px-4 py-2 border">Kode Produk</th>
            <th class="px-4 py-2 border">Nama</th>
            <th class="px-4 py-2 border">Kategori</th>
            <th class="px-4 py-2 border">Harga</th>
            <th class="px-4 py-2 border">Stok</th>
            <th class="px-4 py-2 border">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while($p = mysqli_fetch_assoc($result)){ ?>
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-2 border"><?= $p['kode_produk'] ?></td>
            <td class="px-4 py-2 border"><?= $p['nama'] ?></td>
            <td class="px-4 py-2 border"><?= $p['kategori'] ?></td>
            <td class="px-4 py-2 border">Rp<?= number_format($p['harga']) ?></td>
            <td class="px-4 py-2 border"><?= $p['stok'] ?></td>
            <td class="px-4 py-2 border">
              <a href="produk_edit.php?id=<?= $p['id'] ?>" class="text-blue-500 hover:underline">Edit</a> |
              <a href="javascript:void(0)" onclick="confirmDelete('produk_delete.php?id=<?= $p['id'] ?>')" class="text-red-500 hover:underline">Hapus</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    function confirmDelete(url) {
      Swal.fire({
        title: 'Yakin hapus produk?',
        text: "Data produk akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url;
        }
      })
    }
  </script>
</body>
</html>