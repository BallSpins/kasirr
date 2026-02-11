CREATE DATABASE kasir;
USE kasir;

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50)
);

CREATE TABLE pelanggan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    no_telp VARCHAR(15)
);

CREATE TABLE produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_produk VARCHAR(6) NOT NULL UNIQUE,
    nama VARCHAR(100),
    kategori ENUM('makanan','minuman','cemilan'),
    harga INT,
    stok INT
);

CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tgl DATETIME,
    pelanggan_id INT,
    total INT,
    bayar INT,       
    kembalian INT    
);

CREATE TABLE transaksi_detail (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaksi_id INT,   
    produk_id INT,      
    qty INT,
    subtotal INT,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id),
    FOREIGN KEY (produk_id) REFERENCES produk(id)
);