 <!DOCTYPE html>
 <html>

 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Laporan Aplikasi Keuangan</title>
 	<link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">

 </head>

 <body>

 	<center>
 		<h4>LAPORAN</h4>
 		<h4>SISTEM INFORMASI KEUANGAN</h4>
 	</center>


 	<?php
		include '../koneksi.php';
		if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari']) && isset($_GET['bank'])) {
			$tgl_dari = $_GET['tanggal_dari'];
			$tgl_sampai = $_GET['tanggal_sampai'];
			$bank = $_GET['bank'];
		?>

 		<div class="row">
 			<div class="col-lg-6">
 				<table class="table table-bordered">
 					<tr>
 						<th width="30%">DARI TANGGAL</th>
 						<th width="1%">:</th>
 						<td><?php echo date('d-m-Y', strtotime($tgl_dari)); ?></td>
 					</tr>
 					<tr>
 						<th>SAMPAI TANGGAL</th>
 						<th>:</th>
 						<td><?php echo date('d-m-Y', strtotime($tgl_sampai)); ?></td>
 					</tr>
 					<tr>
 						<th>NAMA KAS</th>
 						<th>:</th>
 						<td>
 							<?php
								if ($bank == "semua") {
									echo "SEMUA NAMA KAS";
								} else {
									$k = mysqli_query($koneksi, "select * from bank where bank_id='$bank'");
									$kk = mysqli_fetch_assoc($k);
									echo $kk['bank_nama'];
								}
								?>

 						</td>
 					</tr>
 				</table>

 			</div>
 		</div>

 		<div class="table-responsive">
 			<table class="table table-bordered table-striped">
 				<thead>
 					<tr>
 						<th width="1%" rowspan="2">NO</th>
 						<th width="10%" rowspan="2" class="text-center">TANGGAL</th>
 						<th rowspan="2" class="text-center">NAMA KAS</th>
 						<th rowspan="2" class="text-center">KETERANGAN</th>
 						<th colspan="2" class="text-center">JENIS</th>
 					</tr>
 					<tr>
 						<th class="text-center">PEMASUKAN</th>
 						<th class="text-center">PENGELUARAN</th>
 					</tr>
 				</thead>
 				<tbody>
 					<?php

						$no = 1;
						$total_pemasukan = 0;
						$total_pengeluaran = 0;
						if ($bank == "semua") {
							$data = mysqli_query($koneksi, "SELECT * FROM transaksi,bank where bank_id=transaksi_kategori and date(transaksi_tanggal)>='$tgl_dari' and date(transaksi_tanggal)<='$tgl_sampai'");
						} else {
							$data = mysqli_query($koneksi, "SELECT * FROM transaksi,bank where bank_id=transaksi_kategori and bank_id='$bank' and date(transaksi_tanggal)>='$tgl_dari' and date(transaksi_tanggal)<='$tgl_sampai'");
						}
						while ($d = mysqli_fetch_array($data)) {

							if ($d['transaksi_jenis'] == "Pemasukan") {
								$total_pemasukan += $d['transaksi_nominal'];
							} elseif ($d['transaksi_jenis'] == "Pengeluaran") {
								$total_pengeluaran += $d['transaksi_nominal'];
							}
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
 							<td class="text-center">
 								<?php
									if ($d['transaksi_jenis'] == "Pengeluaran") {
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
 					<tr>
 						<th colspan="4" class="text-right">TOTAL</th>
 						<td class="text-center text-bold text-success"><?php echo "Rp. " . number_format($total_pemasukan) . " ,-"; ?></td>
 						<td class="text-center text-bold text-danger"><?php echo "Rp. " . number_format($total_pengeluaran) . " ,-"; ?></td>
 					</tr>
 					<tr>
 						<th colspan="4" class="text-right">SALDO</th>
 						<td colspan="2" class="text-center text-bold text-white bg-primary"><?php echo "Rp. " . number_format($total_pemasukan - $total_pengeluaran) . " ,-"; ?></td>
 					</tr>
 				</tbody>
 			</table>



 		</div>

 	<?php
		} else {
		?>

 		<div class="alert alert-info text-center">
 			Silahkan Filter Laporan Terlebih Dulu.
 		</div>

 	<?php
		}
		?>


 	<script>
 		window.print();
 	</script>

 </body>

 </html>