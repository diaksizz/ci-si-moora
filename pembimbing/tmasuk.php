<?php include 'header.php'; ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Transaksi
            <small>Transaksi Masuk</small>
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
                        <h3 class="box-title">Transaksi Pemasukan</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="table-datatable">
                                <thead>
                                    <tr>
                                        <th width="1%">NO</th>
                                        <th width="10%" class="text-center">TANGGAL</th>
                                        <th class="text-center">NAMA KAS</th>
                                        <th class="text-center">KETERANGAN</th>
                                        <th class="text-center">TRANSAKSI MASUK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../koneksi.php';
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM transaksi,bank where bank_id=transaksi_kategori AND transaksi_jenis = 'Pemasukan' order by transaksi_id desc");
                                    while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no++; ?></td>
                                            <td class="text-center"><?php echo date('d-m-Y', strtotime($d['transaksi_tanggal'])); ?></td>
                                            <td><?php echo $d['bank_nama']; ?></td>
                                            <td><?php echo $d['transaksi_keterangan']; ?></td>
                                            <td class="text-center">
                                                <?php
                                                if ($d['transaksi_jenis'] == "Pemasukan") {
                                                    echo "Rp. " . number_format($d['transaksi_nominal']) . " ,-";
                                                } else {
                                                    echo "-";
                                                }
                                                ?>
                                            </td>

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