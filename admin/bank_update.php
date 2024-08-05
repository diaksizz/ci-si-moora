<?php
include '../koneksi.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];
$pemilik  = $_POST['pemilik'];
$nomor  = $_POST['nomor'];
$saldo  = $_POST['saldo'];
$sisa  = $_POST['sisa'];
$keterangan  = $_POST['keterangan'];

mysqli_query($koneksi, "update bank set bank_nama='$nama', bank_pemilik='$pemilik', bank_nomor='$nomor', anggaran='$saldo', bank_saldo='$sisa', keterangan='$keterangan' where bank_id='$id'") or die(mysqli_error($koneksi));
header("location:bank.php");
