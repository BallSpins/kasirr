<div class="w-64 bg-slate-800 text-white min-h-screen p-4">
  <h1 class="text-lg font-bold mb-6">Kasir</h1>
  <ul class="space-y-3">
    <li>
      <a href="../dashboard.php" 
         class="block hover:bg-slate-700 p-2 rounded <?php if(basename($_SERVER['PHP_SELF'])=='dashboard.php') echo 'bg-slate-700'; ?>">
         Dashboard
      </a>
    </li>
    <li>
      <a href="../produk/produk_index.php" 
         class="block hover:bg-slate-700 p-2 rounded <?php if(strpos($_SERVER['PHP_SELF'],'produk')!==false) echo 'bg-slate-700'; ?>">
         Produk
      </a>
    </li>
    <li>
      <a href="../pelanggan/pelanggan_index.php" 
         class="block hover:bg-slate-700 p-2 rounded <?php if(strpos($_SERVER['PHP_SELF'],'pelanggan')!==false) echo 'bg-slate-700'; ?>">
         Pelanggan
      </a>
    </li>
    <li>
      <a href="../transaksi/kasir.php" 
         class="block hover:bg-slate-700 p-2 rounded <?php if(strpos($_SERVER['PHP_SELF'],'transaksi')!==false) echo 'bg-slate-700'; ?>">
         Transaksi
      </a>
    </li>
    <li>
      <a href="../laporan/laporan_pembelian.php" 
         class="block hover:bg-slate-700 p-2 rounded <?php if(strpos($_SERVER['PHP_SELF'],'laporan')!==false) echo 'bg-slate-700'; ?>">
         Laporan
      </a>
    </li>
    <li>
      <a href="../auth/logout.php" 
         class="block bg-red-600 hover:bg-red-700 p-2 rounded mt-6 text-center">
         Logout
      </a>
    </li>
  </ul>
</div>