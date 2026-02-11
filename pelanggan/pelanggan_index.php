<?php
include "../config/koneksi.php";
$pelanggan = mysqli_query($conn,"SELECT * FROM pelanggan");

?>
<!DOCTYPE html>
<html>
<head>
  <title>Data Pelanggan</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-gray-100 min-h-screen flex">
  <?php include "../layout/sidebar.php"; ?>
  <div class="flex-1 p-6">
    <h2 class="text-2xl font-bold mb-6">Data Pelanggan</h2>
    <a href="pelanggan_create.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Pelanggan</a>
    <div class="bg-white shadow-md rounded overflow-x-auto">
      <table class="min-w-full border-collapse">
        <thead>
          <tr class="bg-gray-200">
            <th class="px-4 py-2 border">Nama</th>
            <th class="px-4 py-2 border">No Telp</th>
            <th class="px-4 py-2 border">Aksi</th>
          </tr>
        </thead>
        <tbody>
        <link rel="stylesheet" href="./../sweetalert/sweetalert2.min.css">
        <script src="./../sweetalert/sweetalert2.min.js"></script>
            <script>
              function confirmDelete(url) {
                Swal.fire({
                  title: 'Yakin hapus data pelanggan?',
                  text: "Data pelanggan akan dihapus permanen!",
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

          <?php while($p = mysqli_fetch_assoc($pelanggan)){ ?>
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-2 border"><?= $p['nama'] ?></td>
            <td class="px-4 py-2 border"><?= $p['no_telp'] ?></td>
            <td class="px-4 py-2 border">
           <a href="javascript:void(0)" 
              onclick="confirmDelete('pelanggan_delete.php?id=<?= $p['id'] ?>')" 
              class="text-red-500 hover:underline">Hapus</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>