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
                        <h3 class="box-title">Data Santri</h3>
                        <div class="btn-group pull-right">

                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> &nbsp Tambah Data Santri
                            </button>
                        </div>
                    </div>
                    <div class="box-body">

                        <!-- Modal -->
                        <form action="santri_act.php" method="post">
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Santri</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                <label>Nama Santri</label>
                                                <input type="hidden" name="no" required="required" class="form-control" placeholder="Nama Santri .." value="<?php echo $d['no']; ?>">
                                                <input type="text" name="nama" style="width:100%" required="required" class="form-control" placeholder="Nama Santri ..">
                                            </div>

                                            <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                <label>Jenjang</label>
                                                <input type="text" name="jenjang" style="width:100%" class="form-control" placeholder="Jenjang Santri ..">
                                            </div>

                                            <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                <label>Kamar</label>
                                                <input type="text" name="kamar" style="width:100%" required="required" class="form-control" placeholder="Kamar Santri">
                                            </div>

                                            <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                <label>Wali Santri</label>
                                                <input type="text" name="wali" style="width:100%" required="required" class="form-control" placeholder="Wali Santri">
                                            </div>

                                            <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                <label>Alamat</label>
                                                <textarea name="alamat" style="width:100%" class="form-control" rows="4"></textarea>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
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
                                        <th>JENJANG</th>
                                        <th>ALAMAT</th>
                                        <th>KAMAR</th>
                                        <th>NAMA WALI</th>
                                        <th width="10%">OPSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../koneksi.php';
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM santri");
                                    while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $d['nama']; ?></td>
                                            <td><?php echo $d['jenjang']; ?></td>
                                            <td><?php echo $d['alamat']; ?></td>
                                            <td><?php echo $d['kamar']; ?></td>
                                            <td><?php echo $d['wali']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_bank_<?php echo $d['no'] ?>">
                                                    <i class="fa fa-gear"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_bank_<?php echo $d['no'] ?>">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                                <form action="santri_update.php" method="post">
                                                    <div class="modal fade" id="edit_bank_<?php echo $d['no'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="exampleModalLabel">Edit Santri</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                                        <label>Nama Santri</label>
                                                                        <input type="hidden" name="no" required="required" class="form-control" placeholder="Nama Santri .." value="<?php echo $d['no']; ?>">
                                                                        <input type="text" name="nama" style="width:100%" required="required" class="form-control" placeholder="Nama Santri .." value="<?php echo $d['nama']; ?>">
                                                                    </div>

                                                                    <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                                        <label>Jenjang</label>
                                                                        <input type="text" name="jenjang" style="width:100%" class="form-control" placeholder="Jenjang Santri .." value="<?php echo $d['jenjang']; ?>">
                                                                    </div>

                                                                    <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                                        <label>Kamar</label>
                                                                        <input type="text" name="kamar" style="width:100%" required="required" class="form-control" placeholder="Kamar Santri" value="<?php echo $d['kamar']; ?>">
                                                                    </div>

                                                                    <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                                        <label>Wali Santri</label>
                                                                        <input type="text" name="wali" style="width:100%" required="required" class="form-control" placeholder="Wali Santri" value="<?php echo $d['wali']; ?>">
                                                                    </div>

                                                                    <div class="form-group" style="margin-bottom:15px;width: 100%">
                                                                        <label>Alamat</label>
                                                                        <textarea name="alamat" style="width:100%" class="form-control" rows="4"><?php echo $d['alamat'] ?></textarea>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                                <!-- modal hapus -->
                                                <div class="modal fade" id="hapus_bank_<?php echo $d['no'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                <a href=santri_hapus.php?id=<?php echo $d['no'] ?>" class="btn btn-primary">Hapus</a>
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
<?php include 'footer.php'; ?>