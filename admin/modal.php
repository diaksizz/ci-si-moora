<form action="transaksi_update.php" method="post">
    <div class="modal fade" id="edit_transaksi_<?php echo $d['transaksi_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Edit transaksi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group" style="width:100%;margin-bottom:20px">
                        <label>Tanggal</label>
                        <input type="hidden" name="id" value="<?php echo $d['transaksi_id'] ?>">
                        <input type="text" style="width:100%" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo $d['transaksi_tanggal'] ?>">
                    </div>

                    <div class="form-group" style="width:100%;margin-bottom:20px">
                        <label>Jenis</label>
                        <select name="jenis" style="width:100%" class="form-control" required="required">
                            <option value="">- Pilih -</option>
                            <option <?php if ($d['transaksi_jenis'] == "Pemasukan") {
                                        echo "selected='selected'";
                                    } ?> value="Pemasukan">Pemasukan</option>
                            <option <?php if ($d['transaksi_jenis'] == "Pengeluaran") {
                                        echo "selected='selected'";
                                    } ?> value="Pengeluaran">Pengeluaran</option>
                        </select>
                    </div>

                    <div class="form-group" style="width:100%;margin-bottom:20px">
                        <label>Kategori</label>
                        <select name="kategori" style="width:100%" class="form-control" required="required">
                            <option value="">- Pilih -</option>
                            <?php
                            $kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY kategori ASC");
                            while ($k = mysqli_fetch_array($kategori)) {
                            ?>
                                <option <?php if ($d['transaksi_kategori'] == $k['kategori_id']) {
                                            echo "selected='selected'";
                                        } ?> value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group" style="width:100%;margin-bottom:20px">
                        <label>Nominal</label>
                        <input type="number" style="width:100%" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal .." value="<?php echo $d['transaksi_nominal'] ?>">
                    </div>

                    <div class="form-group" style="width:100%;margin-bottom:20px">
                        <label>Keterangan</label>
                        <textarea name="keterangan" style="width:100%" class="form-control" rows="4"><?php echo $d['transaksi_keterangan'] ?></textarea>
                    </div>

                    <div class="form-group" style="width:100%;margin-bottom:20px">
                        <label>Rekening Bank</label>
                        <select name="bank" class="form-control" required="required" style="width:100%">
                            <option value="">- Pilih -</option>
                            <?php
                            $bank = mysqli_query($koneksi, "SELECT * FROM bank");
                            while ($b = mysqli_fetch_array($bank)) {
                            ?>
                                <option <?php if ($d['transaksi_bank'] == $b['bank_id']) {
                                            echo "selected='selected'";
                                        } ?> value="<?php echo $b['bank_id']; ?>"><?php echo $b['bank_nama']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
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
<div class="modal fade" id="hapus_transaksi_<?php echo $d['transaksi_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Peringatan!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Yakin ingin menghapus data ini ?</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <a href="transaksi_hapus.php?id=<?php echo $d['transaksi_id'] ?>" class="btn btn-primary">Hapus</a>
            </div>
        </div>
    </div>
</div>