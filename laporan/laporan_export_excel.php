<?php
include '../config/koneksi.php';

$today = date('Y-m-d');

// header untuk Excel
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=laporan_harian_$today.xls");
header("Pragma: no-cache");
header("Expires: 0");

// mulai tabel
echo "<table border='1'>";
echo "<tr>
        <th>ID Struk</th>
        <th>Tanggal</th>
        <th>Pelanggan</th>
        <th>Total</th>
      </tr>";

$sql = "SELECT t.id, t.tgl, p.nama AS pelanggan, t.total
        FROM transaksi t
        JOIN pelanggan p ON t.pelanggan_id = p.id
        WHERE DATE(t.tgl) = '$today'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){
    echo "<tr>
            <td>".$row['id']."</td>
            <td>".$row['tgl']."</td>
            <td>".$row['pelanggan']."</td>
            <td>".$row['total']."</td>
          </tr>";
}
echo "</table>";
?>