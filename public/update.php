<?php 

	require_once "../product.php";
	require_once "../koneksi.php";

	$con = new Koneksi();
	$product = new Product($con);

	$id = $_GET['id'];
	$data = [];

	if (isset($_GET['id'])) {
	    $id = $_GET['id'];
	    $where = ['id' => $id];
	    $result = $product->tampilProduct($id, $where);

	    if ($result) {
	        $data = $result[0];
	    } else {
	    	$data = $_POST;
	    } 
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update data</title>

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
	<h2>EDIT DATA PRODUK</h2>

	<form action="" method="POST">
		<table>
			<tr>
				<td><label for="nama">Nama Produk :</label></td>
			</tr>

			<tr>
				<td>
				    <input type="text" name="nama" autocomplete="off" required placeholder="Masukkan nama produk..." value="<?php echo !empty($data) ? $data['nama'] : ''; ?>">
				</td>
			</tr>

			<tr>
				<td><label for="harga">Harga :</label></td>
			</tr>

			<tr>
				<td>
				    <input type="text" name="harga" autocomplete="off" required placeholder="Masukkan harga produk..." value="<?php echo !empty($data) ? $data['harga'] : ''; ?>">
				</td>
			</tr>
			
			<tr>
				<td><label for="deskripsi">Deskripsi :</label></td>
			</tr>

			<tr>
				<td>
					<textarea name="deskripsi" required placeholder="Masukan deskripsi produk..."><?php echo !empty($data) ? $data['deskripsi'] : ''; ?></textarea>
				</td>
			</tr>

			<tr>
				<td>
					<button type="button" onclick="location.href='../index.php'">Kembali</button>
					<button type="submit" name="submit">Simpan</button>
				</td>
			</tr>
		</table>
	</form>

	<?php 

		if (isset($_POST['submit'])) {
			$data = array(
				'nama' => $_POST['nama'],
				'harga' => $_POST['harga'],
				'deskripsi' => $_POST['deskripsi']
			);

			$id = $_GET['id'];
			$where = array('id' => $id);
			
			$product->editProduct($table, $data, $where);

			echo "<script>alert('Data berhasil diubah! ( ﾉ ﾟ▽ ﾟ)ﾉ ');</script>";
			echo "<script>window.location.href = '../index.php';</script>";
		}

	 ?>

</body>
</html>