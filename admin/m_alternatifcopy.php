<?php include 'header.php'; ?>

<?php
include '../koneksi.php';

mysqli_query($koneksi, "TRUNCATE TABLE tabel_alternatif") or die(mysqli_error($koneksi));
mysqli_query($koneksi, "TRUNCATE TABLE tabel_nilai") or die(mysqli_error($koneksi));

$data = mysqli_query($koneksi, "SELECT * FROM kriteria");
while ($d = mysqli_fetch_array($data)) {

    $nama = $d['bank_nama'];
    $penggunaan = $d['frek_penggunaan'];
    $keluar = $d['total_keluar'];
    $anggaran = $d['saldo'];


    if ($penggunaan <= 10) {
        $npenggunaan = 0.1;
    } else if ($penggunaan <= 20) {
        $npenggunaan = 0.2;
    } else if ($penggunaan <= 30) {
        $npenggunaan = 0.3;
    } else if ($penggunaan <= 40) {
        $npenggunaan = 0.4;
    } else if ($penggunaan <= 50) {
        $npenggunaan = 0.5;
    } else if ($penggunaan <= 60) {
        $npenggunaan = 0.6;
    } else if ($penggunaan <= 70) {
        $npenggunaan = 0.7;
    } else if ($penggunaan <= 80) {
        $npenggunaan = 0.8;
    } else if ($penggunaan <= 90) {
        $npenggunaan = 0.9;
    } else if ($penggunaan <= 100) {
        $npenggunaan = 1;
    }

    if ($keluar < 100000) {
        $nkeluar = 0.1;
    } else if ($keluar <= 150000) {
        $nkeluar = 0.2;
    } else if ($keluar <= 200000) {
        $nkeluar = 0.3;
    } else if ($keluar <= 250000) {
        $nkeluar = 0.4;
    } else if ($keluar <= 300000) {
        $nkeluar = 0.5;
    } else if ($keluar <= 350000) {
        $nkeluar = 0.6;
    } else if ($keluar <= 400000) {
        $nkeluar = 0.7;
    } else if ($keluar <= 450000) {
        $nkeluar = 0.8;
    } else if ($keluar <= 500000) {
        $nkeluar = 0.9;
    } else if ($keluar > 500000) {
        $nkeluar = 1;
    }


    if ($anggaran < 100000) {
        $nanggaran = 1;
    } else if ($anggaran <= 150000) {
        $nanggaran = 0.9;
    } else if ($anggaran <= 200000) {
        $nanggaran = 0.8;
    } else if ($anggaran <= 250000) {
        $nanggaran = 0.7;
    } else if ($anggaran <= 300000) {
        $nanggaran = 0.6;
    } else if ($anggaran <= 350000) {
        $nanggaran = 0.5;
    } else if ($anggaran <= 400000) {
        $nanggaran = 0.4;
    } else if ($anggaran <= 450000) {
        $nanggaran = 0.3;
    } else if ($anggaran <= 500000) {
        $nanggaran = 0.2;
    } else if ($anggaran > 501000) {
        $nanggaran = 0.1;
    }

    mysqli_query($koneksi, "insert into tabel_alternatif values(NULL,'$nama','$penggunaan','$keluar','$anggaran')") or die(mysqli_error($koneksi));

    $sqlIdakhir = "SELECT id_alternatif FROM tabel_alternatif ORDER BY id_alternatif DESC limit 1";
    $resultIdakhir = mysqli_query($koneksi, $sqlIdakhir);
    $hasil = mysqli_fetch_assoc($resultIdakhir);
    $id_alternatif = $hasil['id_alternatif'];

    mysqli_query($koneksi, "INSERT INTO tabel_nilai (id_kriteria, id_alternatif, nilai) VALUES (1, $id_alternatif, '$npenggunaan')") or die(mysqli_error($koneksi));

    mysqli_query($koneksi, "INSERT INTO tabel_nilai (id_kriteria, id_alternatif, nilai) VALUES (2, $id_alternatif, '$nkeluar')") or die(mysqli_error($koneksi));

    mysqli_query($koneksi, "INSERT INTO tabel_nilai (id_kriteria, id_alternatif, nilai) VALUES (3, $id_alternatif, '$nanggaran')") or die(mysqli_error($koneksi));
}
?>







<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Data Utama
            <small>Data Santri</small>
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
                        <h3 class="box-title">Data Alternatif</h3>
                    </div>
                    <div class="box-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="table-datatable">
                                <thead>
                                    <tr>
                                        <th width="1%">NO</th>
                                        <th>NAMA</th>
                                        <th>FREKUENSI PENGGUNAAN</th>
                                        <th>TOTAL KELUAR</th>
                                        <th>ANGGARAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../koneksi.php';
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM tabel_alternatif");
                                    while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $d['nama']; ?></td>
                                            <td><?php echo $d['frek_penggunaan']; ?></td>
                                            <td><?php echo $d['kas_keluar']; ?></td>
                                            <td><?php echo $d['anggaran']; ?></td>
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
<?php include 'footer.php';
?>