<?php
include '../koneksi.php';
$nama  = $_POST['nama'];
$pemilik  = $_POST['pemilik'];
$nomor  = $_POST['nomor'];
$anggaran = $_POST['saldo'];
$saldo  = 0;
$keterangan  = $_POST['keterangan'];

mysqli_query($koneksi, "insert into bank values (NULL,'$nama','$pemilik','$nomor','$anggaran','$saldo', '$keterangan')");
header("location:bank.php");
