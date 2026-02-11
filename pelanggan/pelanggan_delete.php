<?php
include "../config/koneksi.php";
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM pelanggan WHERE id=$id");
header("Location: pelanggan_index.php");