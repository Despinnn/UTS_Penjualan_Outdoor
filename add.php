<html>

<head>
	<title>Tambah Data Barang</title>
</head>

<body>
	<?php
	// INCLUDE KONEKSI KE DATABASE
	include_once("config.php");

	if (isset($_POST['Submit'])) {
		$nama = mysqli_real_escape_string($mysqli, $_POST['nama']);
		$kode = mysqli_real_escape_string($mysqli, $_POST['kode']);
		$jumlah = mysqli_real_escape_string($mysqli, $_POST['jumlah']);
		$harga = mysqli_real_escape_string($mysqli, $_POST['harga']);
		$filename = $_FILES['gambar']['name'];

		// CEK DATA TIDAK BOLEH KOSONG
		if (empty($nama) || empty($kode) || empty($jumlah) || empty($harga) || empty($filename)) {

			if (empty($nama)) {
				echo "<font color='red'>Kolom Nama tidak boleh kosong.</font><br/>";
			}

			if (empty($kode)) {
				echo "<font color='red'>Kolom kode tidak boleh kosong.</font><br/>";
			}

			if (empty($jumlah)) {
				echo "<font color='red'>Kolom jumlah tidak boleh kosong.</font><br/>";
			}

			if (empty($harga)) {
				echo "<font color='red'>Kolom harga tidak boleh kosong.</font><br/>";
			}

			if (empty($filename)) {
				echo "<font color='red'>Kolom Gambar tidak boleh kosong.</font><br/>";
			}

			// KEMBALI KE HALAMAN SEBELUMNYA
			echo "<br/><a href='javascript:self.history.back();'>Kembali</a>";
		} else {
			// JIKA SEMUANYA TIDAK KOSONG
			$filetmpname = $_FILES['gambar']['tmp_name'];

			// FOLDER DIMANA GAMBAR AKAN DI SIMPAN
			$folder = 'image/';
			// GAMBAR DI SIMPAN KE DALAM FOLDER
			move_uploaded_file($filetmpname, $folder . $filename);

			// MEMASUKAN DATA DATA + NAMA GAMBAR KE DALAM DATABASE
			$result = mysqli_query($mysqli, "INSERT INTO users(nama,kode,jumlah,harga,gambar) VALUES('$nama', '$kode', '$jumlah', '$harga', '$filename')");

			// MENAMPILKAN PESAN BERHASIL
			echo "<font color='green'>Data Berhasil ditambahkan.";
			echo "<br/><a href='index.php'>Lihat Hasilnya</a>";
		}
	}
	?>
</body>

</html>