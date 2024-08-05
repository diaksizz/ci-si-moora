<?php include 'header.php'; ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Transaksi
            <small>Detail Transaksi</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <section class="col-lg-12">
                <div class="box box-info">

                    <div class="box-header">
                        <h3 class="box-title">Detail Transaksi Pemasukan & Pengeluaran</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="table-datatable">
                                <thead>
                                    <tr>
                                        <th width="1%" rowspan="2">NO</th>
                                        <th class="text-center">JENIS KAS</th>
                                        <th class="text-center">KODE KAS</th>
                                        <th class="text-center">NAMA KAS</th>
                                        <th class="text-center">ANGGARAN</th>
                                        <th class="text-center">TOTAL MASUK</th>
                                        <th class="text-center">TOTAL KELUAR</th>
                                        <th class="text-center">FREK MASUK</th>
                                        <th class="text-center">FREK KELUAR</th>
                                        <th width="10%" class="text-center">SALDO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../koneksi.php';
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT bank_nomor,bank_pemilik,bank_nama,anggaran,keterangan, 
       SUM(CASE WHEN transaksi_jenis = 'Pemasukan' AND transaksi_kategori = bank_id THEN transaksi_nominal ELSE 0 END) as total_masuk,
SUM(CASE WHEN transaksi_jenis = 'Pengeluaran' AND transaksi_kategori = bank_id THEN transaksi_nominal ELSE 0 END) as total_keluar,
SUM(CASE WHEN transaksi_jenis = 'Pemasukan' AND transaksi_kategori = bank_id THEN 1 ELSE 0 END) as frek_masuk,
SUM(CASE WHEN transaksi_jenis = 'Pengeluaran' AND transaksi_kategori = bank_id THEN 1 ELSE 0 END) as frek_keluar
FROM transaksi,bank
GROUP BY bank_id
ORDER BY 
    bank_id ASC;");
                                    while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no++; ?></td>
                                            <td class="text-center"><?php echo $d['bank_nomor']; ?></td>
                                            <td class="text-center"><?php echo $d['bank_pemilik']; ?></td>
                                            <td class="text-center"><?php echo $d['bank_nama']; ?></td>
                                            <td class="text-center"><?php echo "Rp. " . number_format($d['anggaran']) . " ,-"; ?></td>
                                            <td class="text-center"><?php echo "Rp. " . number_format($d['total_masuk']) . " ,-"; ?></td>
                                            <td class="text-center"><?php echo "Rp. " . number_format($d['total_keluar']) . " ,-"; ?></td>
                                            <td class="text-center"><?php echo $d['frek_masuk']; ?></td>
                                            <td class="text-center"><?php echo $d['frek_keluar']; ?></td>
                                            <td class="text-center"><?php
                                                                    $total = $d['anggaran'] + $d['total_masuk'] - $d['total_keluar'];
                                                                    echo "Rp. " . number_format(max(0, $total)) . " ,-";
                                                                    ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </section>

</div>
<?php include 'footer.php'; ?>