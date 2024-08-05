<?php include 'header.php'; ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Perhitungan Moora
            <small>Data Kriteria</small>
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
                        <h3 class="box-title">Data Kriteria</h3>
                    </div>
                    <div class="box-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="table-datatable">
                                <thead>
                                    <tr>
                                        <th width="1%">NO</th>
                                        <th>NAMA</th>
                                        <th>TIPE</th>
                                        <th>BOBOT</th>
                                        <th width="10%">OPSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../koneksi.php';
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM tabel_kriteria");
                                    while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $d['kriteria']; ?></td>
                                            <td><?php echo $d['type']; ?></td>
                                            <td><?php echo $d['bobot']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_bank_<?php echo $d['id_kriteria'] ?>">
                                                    <i class="fa fa-cog"></i>
                                                </button>

                                                <form action="" method="post">
                                                    <div class="modal fade" id="edit_bank_<?php echo $d['id_kriteria'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="exampleModalLabel">Edit Kriteria</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                                        <label>Nama Kriteria</label>
                                                                        <input type="hidden" name="id" required="required" class="form-control" placeholder="Nama Santri .." value="<?php echo $d['id_kriteria']; ?>">
                                                                        <input type="text" name="nama" style="width:100%" required="required" class="form-control" placeholder="Nama Santri .." value="<?php echo $d['kriteria']; ?>">
                                                                    </div>

                                                                    <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                                        <label>Type</label>
                                                                        <?php
                                                                        if ($d['type'] === 'benefit') {
                                                                        ?>
                                                                            <div class="form-check">
                                                                                <input type="radio" class="form-check-input" id="radio1" name="tipe" value="cost">
                                                                                <label class="form-check-label" for="radio1">Cost</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input type="radio" class="form-check-input" id="radio1" name="tipe" value="benefit" checked>
                                                                                <label class="form-check-label" for="radio1">Benefit</label>
                                                                            </div>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <div class="form-check">
                                                                                <input type="radio" class="form-check-input" id="radio1" name="tipe" value="cost" checked>
                                                                                <label class="form-check-label" for="radio1">Cost</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input type="radio" class="form-check-input" id="radio1" name="tipe" value="benefit">
                                                                                <label class="form-check-label" for="radio1">Benefit</label>
                                                                            </div>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>

                                                                    <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                                        <label>bobot</label>
                                                                        <input type="number" name="bobot" style="width:100%" required="required" class="form-control" placeholder="bobot Santri" value="<?php echo $d['bobot']; ?>">
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                    <button type="submit" name="edit-kriteria" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                                <!-- modal hapus -->

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

<?php

if (isset($_POST['edit-kriteria'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $type = $_POST['tipe'];
    $bobot = $_POST['bobot'];
    mysqli_query($koneksi, "UPDATE tabel_kriteria SET kriteria = '$nama', type = '$type', bobot = '$bobot' WHERE id_kriteria = $id") or die(mysqli_error($koneksi));

    echo "<script>alert('Data berhasil disimpan'); window.location='m_kriteria.php';</script>";
}
?>