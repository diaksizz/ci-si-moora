<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Laporan Aplikasi Keuangan</title>
	<link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">

	<style>
		body {
			font-family: 'Times New Roman', Times, serif;
		}
	</style>
</head>

<body>

	<center>
		<h3>LAPORAN</h3>
		<h3>SISTEM INFORMASI KEUANGAN</h3>
	</center>

	<?php
		include '../koneksi.php';

		// Hapus data di tabel_nilai terlebih dahulu
		mysqli_query($koneksi, "DELETE FROM tabel_nilai") or die(mysqli_error($koneksi));
		// Baru kemudian hapus data di tabel_alternatif
		mysqli_query($koneksi, "DELETE FROM tabel_alternatif") or die(mysqli_error($koneksi));

		$data = mysqli_query($koneksi, "SELECT * FROM kriteria");
		while ($d = mysqli_fetch_array($data)) {

			$nama = $d['bank_nama'];
			$penggunaan = $d['frek_penggunaan'];
			$keluar = $d['total_keluar'];
			$anggaran = $d['saldo'];

			// Proses penilaian
			$npenggunaan = ($penggunaan / 100); // Normalisasi penggunaan
			$nkeluar = min($keluar / 500000, 1); // Normalisasi keluar
			$nanggaran = 1 - min($anggaran / 500000, 1); // Normalisasi anggaran

			// Masukkan data ke tabel_alternatif
			mysqli_query($koneksi, "INSERT INTO tabel_alternatif (nama, frek_penggunaan, kas_keluar, anggaran) VALUES ('$nama', '$penggunaan', '$keluar', '$anggaran')") or die(mysqli_error($koneksi));

			// Ambil ID terakhir yang dimasukkan
			$id_alternatif = mysqli_insert_id($koneksi);

			// Masukkan nilai ke tabel_nilai
			mysqli_query($koneksi, "INSERT INTO tabel_nilai (id_kriteria, id_alternatif, nilai) VALUES (1, $id_alternatif, '$npenggunaan')") or die(mysqli_error($koneksi));
			mysqli_query($koneksi, "INSERT INTO tabel_nilai (id_kriteria, id_alternatif, nilai) VALUES (2, $id_alternatif, '$nkeluar')") or die(mysqli_error($koneksi));
			mysqli_query($koneksi, "INSERT INTO tabel_nilai (id_kriteria, id_alternatif, nilai) VALUES (3, $id_alternatif, '$nanggaran')") or die(mysqli_error($koneksi));
		}
	?>

	<div class="table-responsive">
		<div style="display: none;">
			<?php
				// PROSES PENGAMBILAN KRITERIA DARI DB

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

		<?php
			//proses merubah nilai ke angka
			//-- query untuk mendapatkan semua data sample penilaian di tabel tabel_nilai
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

			//MENGHITUNG NILAI OPTIMASI
			$optimasi = array();
			foreach ($alternatif as $id_siswa => $a) {
				$optimasi[$id_siswa] = 0;
				foreach ($kriteria as $id_kriteria => $k) {
					$optimasi[$id_siswa] += $normal[$id_siswa][$id_kriteria] * ($k[1] == 'benefit' ? 1 : -1) * $k[2];
				}
			}

			//MERANGKING

			//--mengurutkan data secara descending dengan tetap mempertahankan key/index array-nya
			arsort($optimasi);
			//-- mendapatkan key/index item array yang pertama
			$index = key($optimasi);
		?>

		<!-- Menampilkan Hasil Akhir Perhitungan Moora -->
		<h3>Dari hasil perhitungan dengan metode moora untuk menentukan uang kas mana yang harus didahulukan sebagai berikut :</h3>

		<ol class="custom-ol">
			<?php
				$prioritas_nama = ''; // Variabel untuk menyimpan nama dengan prioritas pertama

				foreach ($optimasi as $id_optimasi => $value) {
					$nama_simpan = $alternatif[$id_optimasi][0]; // Asumsi $alternatif adalah array dua dimensi
					$status = $rank;

					// Simpan nama dengan prioritas pertama
					if ($rank == 1) {
						$prioritas_nama = $nama_simpan;
					}
				?>
				<li>
					<h3><?php echo $nama_simpan; ?></h3>
				</li>
			<?php
					$rank++;
				}
			?>
		</ol>

		<style>
			.custom-ol {
				list-style-type: none;
				counter-reset: item;
			}

			.custom-ol li {
				counter-increment: item;
			}

			.custom-ol li h3::before {
				content: counter(item) ". ";
				margin-right: 5px;
				/* menambahkan margin kanan antara nomor dan teks */
			}
		</style>

		<h3>Dengan ini kas keuangan mabna khomis di pondok pesantren putri Walisongo yang didahulukan adalah <b><?php echo $prioritas_nama; ?></b>.</h3>

	</div>

	<script>
		window.print();
	</script>

</body>

</html>
