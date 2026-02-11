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
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
);

INSERT INTO user VALUES (NULL,'kasir','123');
INSERT INTO produk VALUES
(NULL,'Nasi Goreng','makanan',12000,12),
(NULL,'Es Teh','minuman',4000,12),
(NULL,'Snack','cemilan',5000,12);


SELECT t.id, t.tgl, p.nama AS pelanggan, p.no_telp, t.total
FROM transaksi t
JOIN pelanggan p ON t.pelanggan_id = p.id;

SELECT t.id, t.tgl, pr.nama AS produk, pr.harga, t.qty, t.subtotal
FROM transaksi t
JOIN produk pr ON t.produk_id = pr.id;

SELECT t.id, t.tgl, p.nama AS pelanggan, pr.nama AS produk, pr.harga, 
       t.qty, t.subtotal, t.total, t.bayar, t.kembalian
FROM transaksi t
JOIN pelanggan p ON t.pelanggan_id = p.id
JOIN produk pr ON t.produk_id = pr.id;

ALTER TABLE transaksi ADD COLUMN user_id INT;

SELECT t.id, t.tgl, u.username AS kasir, p.nama AS pelanggan, pr.nama AS produk, 
       t.qty, t.total, t.bayar, t.kembalian
FROM transaksi t
JOIN user u ON t.user_id = u.id
JOIN pelanggan p ON t.pelanggan_id = p.id
JOIN produk pr ON t.produk_id = pr.id;