<?php
include '../koneksi.php';
$no  = $_POST['no'];
$nama  = $_POST['nama'];
$jenjang  = $_POST['jenjang'];
$alamat  = $_POST['alamat'];
$kamar  = $_POST['kamar'];
$wali  = $_POST['wali'];

mysqli_query($koneksi, "update santri set nama='$nama', jenjang='$jenjang', alamat='$alamat', kamar='$kamar', wali='$wali' where no=$no") or die(mysqli_error($koneksi));
header("location:santri.php");
