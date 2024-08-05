<?php
include '../koneksi.php';
$id  = $_POST['id'];
$tanggal  = $_POST['tanggal'];
$jenis  = "Pengeluaran";
$nominal  = $_POST['nominal'];
$keterangan  = $_POST['keterangan'];
$bank  = $_POST['bank'];

$transaksi = mysqli_query($koneksi, "select * from transaksi where transaksi_id='$id'");
$t = mysqli_fetch_assoc($transaksi);
$bank_lama = $t['transaksi_kategori'];

$rekening = mysqli_query($koneksi, "select * from bank where bank_id='$bank_lama'");
$r = mysqli_fetch_assoc($rekening);

// Kembalikan nominal ke saldo bank lama

if ($t['transaksi_jenis'] == "Pemasukan") {
    $kembalikan = $r['bank_saldo'] - $t['transaksi_nominal'];
    mysqli_query($koneksi, "update bank set bank_saldo='$kembalikan' where bank_id='$bank_lama'");
} else if ($t['transaksi_jenis'] == "Pengeluaran") {
    $kembalikan = $r['bank_saldo'] + $t['transaksi_nominal'];
    mysqli_query($koneksi, "update bank set bank_saldo='$kembalikan' where bank_id='$bank_lama'");
}


if ($jenis == "Pengeluaran") {

    $rekening2 = mysqli_query($koneksi, "select * from bank where bank_id='$bank'");
    $rr = mysqli_fetch_assoc($rekening2);
    $saldo_sekarang = $rr['bank_saldo'];
    $total = $saldo_sekarang - $nominal;
    mysqli_query($koneksi, "update bank set bank_saldo='$total' where bank_id='$bank'");
}

mysqli_query($koneksi, "update transaksi set transaksi_tanggal='$tanggal', transaksi_jenis='$jenis', transaksi_kategori='$bank', transaksi_nominal='$nominal', transaksi_keterangan='$keterangan', transaksi_bank='$bank' where transaksi_id='$id'") or die(mysqli_error($koneksi));
header("location:tkeluar.php");
