<?php
include '../koneksi.php';
$nama  = $_POST['nama'];
$jenjang  = $_POST['jenjang'];
$alamat  = $_POST['alamat'];
$kamar  = $_POST['kamar'];
$wali  = $_POST['wali'];

mysqli_query($koneksi, "insert into santri values (NULL,'$nama','$jenjang','$alamat','$kamar', '$wali')");
header("location:santri.php");
