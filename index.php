<?php
// INCLUDE KONEKSI KE DATABASE
include_once("config.php");

// AMBIL DATA DARI DATABASE BERDASARKAN DATA TERAKHIR DI INPUT
$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC");
?>
<html>

<head>
	<title>Tabel Barang</title>
	<link rel="stylesheet" href="add.css">
</head>

<body>
	<center>
		<div class="tombol">
			<a href="add.html"><button>
					<h4>Tambah Barang Baru</h4>
				</button></a>
		</div>
		</br>
		<table width='60%' border=2>
			<tr bgcolor='#FF7F00' align="center">

				<td>Nama Barang</td>
				<td>Kode Barang</td>
				<td>Jumlah Barang</td>
				<td>Harga Barang</td>
				<td>Gambar</td>
				<td>Update</td>

			</tr>

			<?php

			while ($res = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td>" . $res['nama'] . "</td>";
				echo "<td>" . $res['kode'] . "</td>";
				echo "<td>" . $res['jumlah'] . "</td>";
				echo "<td>" . $res['harga'] . "</td>";
				echo "<td><img width='80' src='image/" . $res['gambar'] . "'</td>";
				echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Kamu yakin untuk delete ini?')\">Delete</a></td>";
			}
			?>

		</table>
	</center>
</body>

</html>