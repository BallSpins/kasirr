<?php
include "../config/koneksi.php";

$pelanggan_id = $_POST['pelanggan_id'];
$produk_id = $_POST['produk_id'];
$qty = $_POST['qty'];

$total = 0;

// simpan transaksi utama
mysqli_query($conn,"INSERT INTO transaksi (tgl,pelanggan_id,total) VALUES (NOW(),$pelanggan_id,0)");
$transaksi_id = mysqli_insert_id($conn);

// simpan detail transaksi
foreach($produk_id as $i => $pid){
    $jumlah = $qty[$i];
    $p = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM produk WHERE id=$pid"));

    // validasi stok
    if($jumlah > $p['stok']){
        die("Stok produk ".$p['nama']." tidak mencukupi!");
    }

    $subtotal = $p['harga'] * $jumlah;
    $total += $subtotal;

    mysqli_query($conn,"INSERT INTO transaksi_detail (transaksi_id,produk_id,qty,subtotal) 
                        VALUES ($transaksi_id,$pid,$jumlah,$subtotal)");

    // kurangi stok
    $stok_baru = $p['stok'] - $jumlah;
    mysqli_query($conn,"UPDATE produk SET stok=$stok_baru WHERE id=$pid");
}

// update total transaksi
mysqli_query($conn,"UPDATE transaksi SET total=$total WHERE id=$transaksi_id");

// redirect ke struk
header("Location: struk.php?id=$transaksi_id");


