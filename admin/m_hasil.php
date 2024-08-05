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
                        <div style="display: none;">
                            <?php
                            // PROSES PENGALMBILAN KRITERIA DARI DB

                            $sql = 'SELECT * FROM tabel_kriteria';
                            $result = $koneksi->query($sql);
                            //-- menyiapkan variable penampung berupa array
                            $kriteria = array();
                            //-- melakukan iterasi pengisian array untuk tiap record data yang didapat
                            foreach ($result as $row) {
                                $kriteria[$row['id_kriteria']] = array($row['kriteria'], $row['type'], $row['bobot']);
                            }

                            // MENAMPILKAN KRITERIA
                            print_r($kriteria);
                            echo "<br><br> Tampilan Kriteria<br><br>";
                            foreach ($kriteria as $id_kriteria => $value) {
                                echo $kriteria[$id_kriteria][0] . " " . $kriteria[$id_kriteria][1] . " = " . $kriteria[$id_kriteria][2] . "<br>";
                            }

                            //proses pengambilan nilai alternatif

                            $sql = 'SELECT * FROM tabel_alternatif';
                            $result = $koneksi->query($sql);
                            //-- menyiapkan variable penampung berupa array
                            $alternatif = array();
                            //-- melakukan iterasi pengisian array untuk tiap record data yang didapat
                            foreach ($result as $row) {
                                $alternatif[$row['id_alternatif']] = array(
                                    $row['nama'],
                                    $row['frek_penggunaan'],
                                    $row['kas_keluar'],
                                    $row['anggaran'],
                                );
                            }
                            $rank = 1;
                            ?>
                        </div>

                        <!-- Menampilkan Inputan Alternatif -->
                        <h3 class="text-center">INPUTAN ALTERNATIF</h1>
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
                                        foreach ($alternatif as $id_siswa => $value) {
                                        ?>
                                            <tr class="gradeX">
                                                <td><?php echo $rank; ?></td>
                                                <?php
                                                for ($i = 0; $i <= 3; $i++) { ?>
                                                    <td><?php echo $alternatif[$id_siswa][$i]; ?></td>
                                                <?php } ?>
                                            </tr>
                                        <?php
                                            $rank++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php

                            //proses merubah nilai ke angka
                            //-- query untuk mendapatkan semua data sample penilaian di tabel moo_nilai
                            $sql = 'SELECT * FROM tabel_nilai ORDER BY id_alternatif,id_kriteria';
                            $result = $koneksi->query($sql);
                            //-- menyiapkan variable penampung berupa array
                            $sample = array();
                            //-- melakukan iterasi pengisian array untuk tiap record data yang didapat
                            foreach ($result as $row) {
                                //-- jika array $sample[$row['id_alternatif']] belum ada maka buat baru
                                //-- $row['id_alternatif'] adalah id kandidat/alternatif
                                if (!isset($sample[$row['id_alternatif']])) {
                                    $sample[$row['id_alternatif']] = array();
                                }
                                $sample[$row['id_alternatif']][$row['id_kriteria']] = $row['nilai'];
                            }

                            ?>
                            <!-- Menampilkan Konversi Nilai ke Angka Inisialisasi -->
                            <h3 class="text-center">KONVERSI NILAI</h1>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="table-datatable">
                                        <thead>
                                            <tr>
                                                <th width="1%">NO</th>
                                                <th>FREKUENSI PENGGUNAAN</th>
                                                <th>TOTAL KELUAR</th>
                                                <th>ANGGARAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $rank = 1;
                                            foreach ($sample as $id_sample => $values) {
                                            ?>
                                                <tr class="gradeX">
                                                    <td><?php echo $rank; ?></td>
                                                    <?php
                                                    foreach ($kriteria as $id_kriteria => $value) { ?>
                                                        <td><?php echo $values[$id_kriteria]; ?></td>
                                                    <?php } ?>
                                                </tr>
                                            <?php
                                                $rank++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php

                                //PROSES NORMALISASI MATRIX
                                //-- inisialisasi nilai normalisasi dengan nilai dari $sample
                                $normal = $sample;
                                foreach ($kriteria as $id_kriteria => $k) {
                                    //-- inisialisasi nilai pembagi tiap kriteria
                                    $pembagi = 0;
                                    foreach ($alternatif as $id_siswa => $a) {
                                        $pembagi += pow($sample[$id_siswa][$id_kriteria], 2);
                                    }
                                    foreach ($alternatif as $id_alternatif => $a) {
                                        $normal[$id_alternatif][$id_kriteria] /= sqrt($pembagi);
                                    }
                                }

                                ?>
                                <!-- Menampilkan hasil Normalisasi Matrik -->
                                <h3 class="text-center">NORMALISASI MATRIX</h1>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="table-datatable">
                                            <thead>
                                                <tr>
                                                    <th width="1%">NO</th>
                                                    <th>FREKUENSI PENGGUNAAN</th>
                                                    <th>TOTAL KELUAR</th>
                                                    <th>ANGGARAN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $rank = 1;
                                                foreach ($normal as $id_normal => $value) {
                                                ?>
                                                    <tr class="gradeX">
                                                        <td><?php echo $rank; ?></td>
                                                        <?php
                                                        foreach ($kriteria as $id_kriteria => $value) { ?>
                                                            <td><?php echo $normal[$id_normal][$id_kriteria]; ?></td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php
                                                    $rank++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php

                                    //MENGHITUNG NILAI OPTIMASI
                                    $optimasi = array();
                                    foreach ($alternatif as $id_siswa => $a) {
                                        $optimasi[$id_siswa] = 0;
                                        foreach ($kriteria as $id_kriteria => $k) {
                                            $optimasi[$id_siswa] += $normal[$id_siswa][$id_kriteria] * ($k[1] == 'benefit' ? 1 : -1) * $k[2];
                                        }
                                    }

                                    ?>
                                    <!-- Menampilkan Nilai Optimasi -->
                                    <h3 class="text-center">NILAI OPTIMASI</h1>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="table-datatable">
                                                <thead>
                                                    <tr>
                                                        <th width="1%">NO</th>
                                                        <th>NAMA KAS</th>
                                                        <th>NILAI AKHIR</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $rank = 1;
                                                    foreach ($optimasi as $id_optimasi => $value) {
                                                    ?>
                                                        <tr class="gradeX">
                                                            <td><?php echo $rank; ?></td>
                                                            <td><?php echo $alternatif[$id_optimasi][0]; ?></td>
                                                            <td><?php echo $optimasi[$id_optimasi]; ?></td>
                                                        </tr>
                                                    <?php
                                                        $rank++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php

                                        //MERANGKING

                                        //--mengurutkan data secara descending dengan tetap mempertahankan key/index array-nya
                                        arsort($optimasi);
                                        //-- mendapatkan key/index item array yang pertama
                                        $index = key($optimasi);

                                        //-- menampilkan hasil akhir
                                        ?>
                                        <h3 class="text-center">MENGURUTKAN NILAI OPTIMASI</h1>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped" id="table-datatable">
                                                    <thead>
                                                        <tr>
                                                            <th width="1%">NO</th>
                                                            <th>NAMA KAS</th>
                                                            <th>NILAI AKHIR</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $rank = 1;
                                                        foreach ($optimasi as $id_optimasi => $value) {
                                                        ?>
                                                            <tr class="gradeX">
                                                                <td><?php echo $rank; ?></td>
                                                                <td><?php echo $alternatif[$id_optimasi][0]; ?></td>
                                                                <td><?php echo $optimasi[$id_optimasi]; ?></td>
                                                            </tr>
                                                        <?php
                                                            $rank++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php
                                            $rank = 1;
                                            ?>

                                            <!-- Menampilkan Hasil Akhir Perhitungan Moora -->
                                            <h3 class="text-center">HASIL AKHIR</h1>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped" id="table-datatable">
                                                        <thead>
                                                            <tr>
                                                                <th width="1%">NO</th>
                                                                <th>NAMA KAS</th>
                                                                <th>NILAI</th>
                                                                <th>PRIORITAS</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($optimasi as $id_optimasi => $value) {
                                                                $nama_simpan = $alternatif[$id_optimasi][0];
                                                                $status = $rank;
                                                            ?>
                                                                <tr class="gradeX">
                                                                    <td><?php echo $rank; ?></td>
                                                                    <td><?php echo $nama_simpan ?></td>
                                                                    <td><?php echo $optimasi[$id_optimasi]; ?></td>
                                                                    <td><?php echo $status ?></td>
                                                                </tr>
                                                            <?php
                                                                $rank++;
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                    </div>
            </section>
        </div>
    </section>

</div>
<?php include 'footer.php'; ?>