<?php
include '../koneksi.php';
$no  = $_GET['id'];

mysqli_query($koneksi, "delete from santri where no='$no'");
header("location:santri.php");
