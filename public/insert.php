<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Insert data</title>

	<link rel="stylesheet" type="text/css" href="../css/style.css?<?php echo time(); ?>">
</head>
	<script type="text/javascript">
		function hanyaAngka(event) {
			var kodeTombol = event.which || event.keyCode;

			if (kodeTombol == 9 || kodeTombol == 8 || kodeTombol == 46 || kodeTombol == 37 || kodeTombol == 39) {
				return true;
			}

			if (kodeTombol < 48 || kodeTombol > 57) {
				return false;
			}
		}
	</script>
<body>
	<h2>TAMBAH PRODUK BARU</h2>

	<form action="?submit=true" method="POST">
		<table border="0">
			<tr>
				<td>Nama Produk :</td>
			</tr>

			<tr>
				<td>
					<input type="text" name="nama" autocomplete="off" required placeholder="Masukan nama produk...">
				</td>
			</tr>

			<tr>
				<td>Harga :</td>
			</tr>

			<tr>
				<td>
					<input type="text" name="harga" autocomplete="off" required onkeydown="return hanyaAngka(event)" placeholder="Masukan harga...">
				</td>
			</tr>
			
			<tr>
				<td>Deskripsi :</td>
			</tr>

			<tr>
				<td>
					<textarea name="deskripsi" required placeholder="Masukan deskripsi produk..."></textarea>
				</td>
			</tr>

			<tr>
				<td>
					<button onclick="location.href='../index.php'">Kembali</button>
					<button type="submit" name="submit">Tambah</button>
				</td>
			</tr>
		</table>
	</form>

	<?php 

		require_once "../product.php";

		$product = new Product();

		$nama = "";
		$harga = "";
		$deskripsi = "";

		if (isset($_POST['submit'])) {
			$nama = $_POST['nama'];
			$harga = $_POST['harga'];
			$deskripsi = $_POST['deskripsi'];

			$data = array("nama" => $nama, "harga" => $harga, "deskripsi" => $deskripsi);

			$product->tambahProduct($table, $data);

			echo "<script>alert('Data berhasil ditambahkan! (～￣▽￣)～');</script>";
			echo "<script>window.location.href = '../index.php';</script>";
		}

	 ?>

</body>
</html>