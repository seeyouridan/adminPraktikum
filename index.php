	<?php 

	include 'product.php';

	$con = new Product();
	$table = 'products';

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Halaman Admin</title>

	<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>">
</head>
<body>
	<nav>
		<p>RAFLY'S STORE &nbsp; o(*￣▽￣*)ブ</p>
	</nav>

	<h3>CRUD KATALOG SEDERHANA</h3>

	<section>
		<table border="1" cellpadding="10">
			<tr>
				<th>No</th>
				<th>Nama Produk</th>
				<th>Deskripsi</th>
				<th>Harga</th>
				<th>Gambar</th>
				<th>Aksi</th>
			</tr>

			<?php 

				$row = $con->tampilProduct($table);
				$no = 1;

				foreach ($row as $data) {

			 ?>

			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $data['nama'] ?></td>
				<td><?php echo $data['deskripsi'] ?></td>
				<td><?php echo $data['harga'] ?></td>
				<td>Tidak ada Gambar</td>
				<td>
					<a class="btnAksi" href="public/update.php?id=<?php echo !empty($data) ? $data['id'] : ''; ?>&table=<?php echo $table; ?>">Edit</a>
					<a class="btnAksi" onclick="return confirm('Anda yakin ingin menghapus data?');" href="?action=hapus&id=<?php echo $data['id']; ?>">Hapus</a>
				</td>
			</tr>

			<?php } ?>
		</table>
	</section>

	<h4><button onclick="location.href='public/insert.php?submit=false'">Tambah Data</button></h4>

	<?php 

		if (@$_GET['action'] == "hapus") {
			$where = ['id' => $_GET['id']];

			$con->hapusProduct($table, $where);

			echo "<script>alert('Data berhasil dihapus! (っ °Д °;)っ ');</script>";
			echo "<script>window.location.href = 'index.php';</script>";
		}

	 ?>

</body>
</html>