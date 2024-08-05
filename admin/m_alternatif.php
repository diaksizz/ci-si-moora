<?php include 'header.php'; ?>

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
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target="#transaksi">
                                <i class="fa fa-circle-info"></i></i> &nbsp Data Transaksi
                            </button>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> &nbsp Tambah Data Alternatif
                            </button>
                        </div>
                    </div>
                    <div class="box-body">

                        <!-- data transaksi -->
                        <div class="modal fade" id="transaksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Data Transaksi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="table-datatable">
                                                <thead>
                                                    <tr>
                                                        <th width="1%">NO</th>
                                                        <th>NAMA KAS</th>
                                                        <th>FREKUENSI PENGGUNAAN</th>
                                                        <th>TOTAL KELUAR</th>
                                                        <th>ANGGARAN</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include '../koneksi.php';
                                                    $no = 1;
                                                    $data = mysqli_query($koneksi, "SELECT * FROM kriteria");
                                                    while ($d = mysqli_fetch_array($data)) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $no++; ?></td>
                                                            <td><?php echo $d['bank_nama']; ?></td>
                                                            <td><?php echo $d['frek_penggunaan']; ?></td>
                                                            <td><?php echo "Rp. " . number_format($d['total_keluar']) . " "; ?></td>
                                                            <td><?php echo "Rp. " . number_format($d['saldo']) . " "; ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <form action="" method="post">
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Alternatif</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                <label>Nama Kas</label>
                                                <input type="text" name="nama" style="width:100%" required="required" class="form-control" placeholder="Nama Kas ..">
                                            </div>

                                            <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                <label>Frekuensi Penggunaan</label>
                                                <input type="number" name="penggunaan" style="width:100%" class="form-control">
                                            </div>

                                            <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                <label>Total Keluar</label>
                                                <input type="number" name="keluar" style="width:100%" class="form-control">
                                            </div>

                                            <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                <label>Sisa Anggaran</label>
                                                <input type="number" name="anggaran" style="width:100%" class="form-control">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" name="tambah-alternatif" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="table-datatable">
                                <thead>
                                    <tr>
                                        <th width="1%">NO</th>
                                        <th>NAMA</th>
                                        <th>FREKUENSI PENGGUNAAN</th>
                                        <th>TOTAL KELUAR</th>
                                        <th>ANGGARAN</th>
                                        <th width="10%">OPSI</th>
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
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_bank_<?php echo $d['id_alternatif'] ?>">
                                                    <i class="fa fa-cog"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_bank_<?php echo $d['id_alternatif'] ?>">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                                <form action="" method="post">
                                                    <div class="modal fade" id="edit_bank_<?php echo $d['id_alternatif'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="exampleModalLabel">Edit Alternatif</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                                        <label>Nama Kas</label>
                                                                        <input type="hidden" name="id" required="required" class="form-control" placeholder="Nama Santri .." value="<?php echo $d['id_alternatif']; ?>">
                                                                        <input type="text" name="nama" style="width:100%" required="required" class="form-control" placeholder="Nama Santri .." value="<?php echo $d['nama']; ?>">
                                                                    </div>

                                                                    <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                                        <label>Frekuensi Penggunaan</label>
                                                                        <input type="number" name="penggunaan" style="width:100%" class="form-control" value="<?php echo $d['frek_penggunaan']; ?>">
                                                                    </div>

                                                                    <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                                        <label>Keluar</label>
                                                                        <input type="number" name="keluar" style="width:100%" class="form-control" value="<?php echo $d['kas_keluar']; ?>">
                                                                    </div>

                                                                    <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                                        <label>Sisa Anggaran</label>
                                                                        <input type="number" name="anggaran" style="width:100%" class="form-control" value="<?php echo $d['anggaran']; ?>">
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-primary" name="edit-alternatif">Simpan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                                <!-- modal hapus -->
                                                <div class="modal fade" id="hapus_bank_<?php echo $d['id_alternatif'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <p>Yakin ingin menghapus data ini ?</p>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <form method="post" action="">
                                                                    <input type="text" name="id" value="<?php echo $d['id_alternatif'] ?>">
                                                                    <button type="submit" name="hapus-alternatif" class="btn btn-primary">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

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
<?php include 'footer.php';

if (isset($_POST['edit-alternatif'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $penggunaan = $_POST['penggunaan'];
    $keluar = $_POST['keluar'];
    $anggaran = $_POST['anggaran'];

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

    mysqli_query($koneksi, "UPDATE tabel_nilai SET nilai = '$npenggunaan' WHERE id_kriteria='1' AND id_alternatif = $id") or die(mysqli_error($koneksi));

    mysqli_query($koneksi, "UPDATE tabel_nilai SET nilai = '$nkeluar' WHERE id_kriteria='2' AND id_alternatif = $id") or die(mysqli_error($koneksi));

    mysqli_query($koneksi, "UPDATE tabel_nilai SET nilai = '$nanggaran' WHERE id_kriteria='3' AND id_alternatif = $id") or die(mysqli_error($koneksi));

    mysqli_query($koneksi, "UPDATE tabel_alternatif SET nama = '$nama', frek_penggunaan = '$penggunaan', kas_keluar = '$keluar', anggaran = '$anggaran' WHERE id_alternatif = $id") or die(mysqli_error($koneksi));
    echo "<script>alert('Data berhasil disimpan'); window.location='m_alternatif.php';</script>";
} elseif (isset($_POST['tambah-alternatif'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $penggunaan = $_POST['penggunaan'];
    $keluar = $_POST['keluar'];
    $anggaran = $_POST['anggaran'];


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

    echo "<script>alert('Data berhasil disimpan'); window.location='m_alternatif.php';</script>";
} elseif (isset($_POST['hapus-alternatif'])) {
    $id = $_POST['id'];
    mysqli_query($koneksi, "DELETE FROM tabel_alternatif WHERE id_alternatif='$id'") or die(mysqli_error($koneksi));
    echo "<script>alert('Data berhasil disimpan'); window.location='m_alternatif.php';</script>";
}
?>