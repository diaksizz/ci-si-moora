<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Data Utama
      <small>Data kas</small>
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
            <h3 class="box-title">Data Kas</h3>
            <div class="btn-group pull-right">
              <button type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target="#Informasi">
                <i class="fa fa-circle-info"></i></i> &nbsp Informasi
              </button>
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Kas
              </button>
            </div>
          </div>
          <div class="box-body">
            <!-- Modal Informasi -->
            <div class="modal fade" id="Informasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                    <p><b>Anggaran</b> adalah untuk modal awal, anggaran tidak berpengaruh terhadap sisa saldo atau yang lain. hanya sebagai informasi, dapat diubah dengan aman dan disesuaikan.</p>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal -->
            <form action="bank_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah bank</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Nama Kas</label>
                        <input type="text" name="nama" required="required" class="form-control" placeholder="Nama Kas ..">
                      </div>

                      <div class="form-group">
                        <label>Kode Kas</label>
                        <input type="text" name="pemilik" class="form-control" placeholder="Kode Kas ..">
                      </div>

                      <div class="form-group">
                        <label>Jenis Kas</label>
                        <select class="form-control" name="nomor">
                          <option value="Besar">Besar</option>
                          <option value="Kecil">Kecil</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Anggaran</label>
                        <input type="number" name="saldo" required="required" class="form-control" placeholder="Saldo Anggaran ..">
                      </div>

                      <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" style="width:100%" class="form-control" rows="4"></textarea>
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
                    <th>NAMA KAS</th>
                    <th>KODE KAS</th>
                    <!-- <th>JENIS KAS</th> -->
                    <th>ANGGARAN</th>
                    <th>SISA SALDO</th>
                    <th>KETERANGAN</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../koneksi.php';
                  $no = 1;
                  $data = mysqli_query($koneksi, "SELECT * FROM bank");
                  while ($d = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['bank_nama']; ?></td>
                      <td><?php echo $d['bank_pemilik']; ?></td>
                      <!-- <td><?php echo $d['bank_nomor']; ?></td> -->
                      <td><?php echo "Rp. " . number_format($d['anggaran']) . " ,-"; ?></td>
                      <td><?php echo "Rp. " . number_format($d['bank_saldo']) . " ,-"; ?></td>
                      <td><?php echo $d['keterangan']; ?></td>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_bank_<?php echo $d['bank_id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <?php
                        if ($d['bank_id'] != 1) {
                        ?>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_bank_<?php echo $d['bank_id'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                        <?php
                        }
                        ?>

                        <form action="bank_update.php" method="post">
                          <div class="modal fade" id="edit_bank_<?php echo $d['bank_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="exampleModalLabel">Edit Kas</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                  <div class="form-group" style="margin-bottom:15px;width: 100%">
                                    <label>Nama Kas</label>
                                    <input type="hidden" name="id" required="required" class="form-control" placeholder="Nama bank .." value="<?php echo $d['bank_id']; ?>">
                                    <input type="text" name="nama" style="width:100%" required="required" class="form-control" placeholder="Nama bank .." value="<?php echo $d['bank_nama']; ?>">
                                  </div>

                                  <div class="form-group" style="margin-bottom:15px;width: 100%">
                                    <label>Kode Kas</label>
                                    <input type="text" name="pemilik" style="width:100%" class="form-control" placeholder="Nama pemiliki rekening bank .." value="<?php echo $d['bank_pemilik']; ?>">
                                  </div>

                                  <div class="form-group" style="margin-bottom:15px;width: 100%">
                                    <label>Jenis Kas</label>
                                    <select class="form-control" name="nomor" style="width:100%">
                                      <option value="Besar" <?= ($d['bank_nomor'] === 'Besar') ? 'selected' : '' ?>>Besar</option>
                                      <option value="Kecil" <?= ($d['bank_nomor'] === 'Kecil') ? 'selected' : '' ?>>Kecil</option>
                                    </select>
                                  </div>

                                  <div class="form-group" style="margin-bottom:15px;width: 100%">
                                    <label>Anggaran</label>
                                    <input type="number" name="saldo" style="width:100%" required="required" class="form-control" placeholder="Anggaran..." value="<?php echo $d['anggaran']; ?>">
                                  </div>

                                  <div class="form-group" style="margin-bottom:15px;width: 100%">
                                    <label>Sisa Saldo</label>
                                    <input type="number" name="sisa" style="width:100%" required="required" class="form-control" placeholder="Sisa Saldo" value="<?php echo $d['bank_saldo']; ?>">
                                  </div>

                                  <div class="form-group" style="margin-bottom:15px;width: 100%">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" style="width:100%" class="form-control" rows="4"><?php echo $d['keterangan'] ?></textarea>
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
                        <div class="modal fade" id="hapus_bank_<?php echo $d['bank_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="bank_hapus.php?id=<?php echo $d['bank_id'] ?>" class="btn btn-primary">Hapus</a>
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