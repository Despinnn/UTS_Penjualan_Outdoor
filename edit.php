<?php
// INCLUDE KONEKSI KE DATABASE
include_once("config.php");

if (isset($_POST['update'])) {

	// AMBIL ID DATA
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);

	// AMBIL NAMA FILE FOTO SEBELUMNYA
	$data = mysqli_query($mysqli, "SELECT gambar FROM users WHERE id='$id'");
	$dataImage = mysqli_fetch_assoc($data);
	$oldImage = $dataImage['gambar'];

	// AMBIL DATA DATA DIDALAM INPUT
	$nama = mysqli_real_escape_string($mysqli, $_POST['nama']);
	$kode = mysqli_real_escape_string($mysqli, $_POST['kode']);
	$jumlah = mysqli_real_escape_string($mysqli, $_POST['jumlah']);
	$harga = mysqli_real_escape_string($mysqli, $_POST['harga']);
	$filename = $_FILES['newImage']['name'];

	// CEK DATA TIDAK BOLEH KOSONG
	if (empty($nama) || empty($kode) || empty($jumlah) || empty($harga)) {

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
	} else {

		// JIKA FOTO DI GANTI
		if (!empty($filename)) {
			$filetmpname = $_FILES['newImage']['tmp_name'];
			$folder = "image/";

			// GAMBAR LAMA DI DELETE
			unlink($folder . $oldImage) or die("GAGAL");

			// GAMBAR BARU DI MASUKAN KE FOLDER
			move_uploaded_file($filetmpname, $folder . $filename);

			// NAMA FILE FOTO + DATA YANG DI GANTIBARU DIMASUKAN
			$result = mysqli_query($mysqli, "UPDATE users SET nama='$nama',kode='$kode',jumlah='$jumlah',harga='$harga',gambar='$filename' WHERE id=$id");
		}

		// MEMASUKAN DATA YANG DI UPDATE KECUALI GAMBAR
		$result = mysqli_query($mysqli, "UPDATE users SET nama='$nama',kode='$kode',jumlah='$jumlah',harga='$harga' WHERE id=$id");

		// REDIRECT KE HALAMAN INDEX.PHP
		header("Location: index.php");
	}
}
?>
<?php
// AMBIL ID DARI URL
$id = $_GET['id'];

// AMBIL DATA BERDASARKAN ID
$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");

while ($res = mysqli_fetch_array($result)) {
	$name = $res['nama'];
	$code = $res['kode'];
	$amount = $res['jumlah'];
	$price = $res['harga'];
	$image = $res['gambar'];
}
?>
<html>

<head>
	<title>Edit Data</title>
	<link rel="stylesheet" href="add.css">
</head>

<body>
	<center>
		<div class="tombol">
			<a href="index.php"><button><b>Home</b></button></a>
		</div>
		<br /><br />

		<form name="form1" method="post" action="edit.php" enctype="multipart/form-data">
			<table border="0">
				<tr>
					<td>Nama Barang</td>
					<td><input type="text" name="nama" value="<?php echo $name; ?>"></td>
				</tr>
				<tr>
					<td>Kode Barang</td>
					<td><input type="text" name="kode" value="<?php echo $code; ?>"></td>
				</tr>
				<tr>
					<td>Jumlah Barang</td>
					<td><input type="text" name="jumlah" value="<?php echo $amount; ?>"></td>
				</tr>
				<tr>
					<td>harga Barang</td>
					<td><input type="text" name="harga" value="<?php echo $price; ?>"></td>
				</tr>
				<tr>
					<td>Gambar</td>
					<td><img width="100" src="image/<?php echo $image ?>"></td>
					<td><input type="file" name="newImage"></td>
				</tr>
				<tr>
					<td><input type="hidden" name="id" value=<?php echo $_GET['id']; ?>></td>
					<td><input type="submit" name="update" value="Update"></td>
				</tr>
			</table>
		</form>
	</center>
</body>

</html>