<?php
class Pelanggan {

	private $mysqli;

	function __construct($conn){
		$this->mysqli = $conn;
	}

  // public function login($username,$password)
  // {
  //   $db = $this->mysqli->conn;
  //   $db->query("SELECT FROM pegawai WHERE username = 'username' && password = 'password')") or die ($db->error);
  //   echo "<script>alert('Berhasil')</script>";
  //   echo "<script>location.replace('lamanStockSparepart.php')</script>";
  // }
?>
