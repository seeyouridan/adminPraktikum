<?php 
	
	define('DB_HOST', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'db_idan');

	$table = 'products';

	class Koneksi {
		public $mysqli;

		function __construct(){
			$this->mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
			if ($this->mysqli->connect_errno) {
				echo "Gagal koneksi ke database : " . $this->mysqli->connect_errno;
			}
		}

		function select($table) {
			$sql = ("SELECT * FROM $table");

			if (!empty($where)) {
				$conditions = array();
				foreach ($where as $key => $value) {
					$conditions[] = "$key = '$value'";
				}

				$whereClause = implode(' AND ', $conditions);
				$sql .= " WHERE $whereClause";
			}

			$result = $this->mysqli->query($sql);
			
			if ($result) {
				return $result->fetch_all(MYSQLI_ASSOC);
			} else {
				return false;
			}
		}

		function insert($table, $data) {
			$sql = "INSERT INTO $table";
			$row = null;
			$value = null;

			foreach ($data as $key => $nilai) {
				$row .= "," . $key;
				$value .= ",'" . $nilai . "'";
			}

			$sql .= "(" . substr($row, 1) . ")";
			$sql .= "VALUES (" . substr($value, 1) . ")";

			$query = $this->mysqli->prepare($sql) or die($this->mysqli->error);
			$query->execute();
		}

		function update($table, $field, $where) {
			$sql = "UPDATE $table SET";
			$set = '';

			foreach ($field as $key => $value) {
				$set .= ", " . $key . " = '" . $value . "'";
			}

			$setWhere = '';

			foreach ($where as $key => $value) {
				$setWhere .= " AND " . $key . " = '" . $value . "'";
			}

			$setWhere = substr($setWhere, 5);

			$sql .= " $set WHERE $setWhere";

			$query = $this->mysqli->prepare($sql) or die($this->mysqli->error);
			$query->execute();
		}

		function delete($table, $where) {
			$setWhere = '';

			foreach ($where as $key => $value) {
				$setWhere .= $key . "='" . $value . "' AND";
			}

			$setWhere = rtrim($setWhere, ' AND ');

			$sql = "DELETE FROM $table WHERE $setWhere";

			$query = $this->mysqli->prepare($sql) or die($this->mysqli->error);
			$query->execute();
		}

		function __destruct() {
			$this->mysqli->close();
		}
	}

 ?>