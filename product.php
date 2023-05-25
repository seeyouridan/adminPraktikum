<?php 
	
	require_once "koneksi.php";

	class Product {
		public $db;

		function __construct() {
			$this->db = new Koneksi();
		}

		function tampilProduct($table, $where = []) {
			$result = $this->db->select($table, $where);

			return $result;
		}

		function tambahProduct($table, $data) {
			$this->db->insert($table, $data);
		}

		function editProduct($table, $data, $where) {
			$this->db->update($table, $data, $where);
		}

		function hapusProduct($table, $where) {
			$this->db->delete($table, $where);
		}
	}

	$con = new Product();

 ?>