<?php
include "../config/koneksi.php";
$produk = mysqli_query($conn,"SELECT * FROM produk");
$pelanggan = mysqli_query($conn,"SELECT * FROM pelanggan");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Transaksi Kasir</title>
  <link rel="stylesheet" href="../css/style.css">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function addRow(){
      const list = document.getElementById("produkList");
      const row = document.createElement("div");
      row.className = "flex space-x-2 mb-2 items-center";
      row.innerHTML = `
        <select name="produk_id[]" class="border rounded p-2 flex-1" onchange="updateRow(this)">
          <option value="" disabled selected>Pilih Produk...</option>
          <?php mysqli_data_seek($produk,0); while($p = mysqli_fetch_assoc($produk)){ ?>
            <option value="<?= $p['id'] ?>" 
                    data-harga="<?= $p['harga'] ?>" 
                    data-stok="<?= $p['stok'] ?>"
                    <?= $p['stok'] == 0 ? 'disabled' : '' ?>>
              <?= $p['nama'] ?> (Rp<?= number_format($p['harga']) ?> | Stok: <?= $p['stok'] ?>)
            </option>
          <?php } ?>
        </select>
        <input type="number" name="qty[]" value="1" min="1" class="border rounded p-2 w-20" oninput="updateRow(this)">
        <span class="harga w-24">Rp0</span>
        <span class="subtotal w-32 font-semibold">Rp0</span>
      `;
      list.appendChild(row);
    }

    function updateRow(el){
      const row = el.closest("div");
      const select = row.querySelector("select");
      if(!select.value){ return; }

      const harga = parseInt(select.options[select.selectedIndex].dataset.harga);
      const stok = parseInt(select.options[select.selectedIndex].dataset.stok);
      const qtyInput = row.querySelector("input[name='qty[]']");
      qtyInput.max = stok;

      if(parseInt(qtyInput.value) > stok){
        qtyInput.value = stok;
        Swal.fire({
          icon: 'error',
          title: 'Jumlah pembelian tidak boleh lebih dari stok',
          text: 'Stok tersedia hanya '+stok+' unit',
        });
      } else if(stok === 0){
        Swal.fire({
          icon: 'warning',
          title: 'Stok tidak mencukupi',
          text: 'Produk ini sudah habis',
        });
      }

      const qty = parseInt(qtyInput.value) || 0;
      const subtotal = harga * qty;

      row.querySelector(".harga").innerText = "Rp"+harga.toLocaleString('id-ID');
      row.querySelector(".subtotal").innerText = "Rp"+subtotal.toLocaleString('id-ID');

      updateTotal();
    }

    function updateTotal(){
      let total = 0;
      document.querySelectorAll(".subtotal").forEach(el=>{
        const val = el.innerText.replace("Rp","").replace(/\./g,"").replace(/,/g,"");
        total += parseInt(val) || 0;
      });
      document.getElementById("totalDisplay").innerText = "Total: Rp"+total.toLocaleString('id-ID');
    }
  </script>
</head>
<body class="bg-gray-100 min-h-screen flex">
  <?php include "../layout/sidebar.php"; ?>
  <div class="flex-1 p-6">
    <h2 class="text-2xl font-bold mb-6">Transaksi Kasir</h2>
    <form action="simpan.php" method="post" class="bg-white shadow-md rounded p-6">
      <div class="mb-4">
        <label class="block mb-2 font-semibold">Pelanggan</label>
        <select name="pelanggan_id" class="border rounded w-full p-2">
          <?php while($pl = mysqli_fetch_assoc($pelanggan)){ ?>
            <option value="<?= $pl['id'] ?>"><?= $pl['nama'] ?> (<?= $pl['no_telp'] ?>)</option>
          <?php } ?>
        </select>
      </div>

      <div id="produkList" class="mb-4"></div>

      <button type="button" onclick="addRow()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded mb-4">Tambah Produk</button>

      <p id="totalDisplay" class="text-right font-bold mb-4">Total: Rp0</p>

      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Simpan Transaksi</button>
    </form>
  </div>
</body>
</html>