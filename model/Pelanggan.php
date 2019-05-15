<?php
class Pelanggan {

	private $mysqli;

	function __construct($conn){
		$this->mysqli = $conn;
	}

	public function tampilPelanggan(){
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM pelanggan";
		$squery = $db->query($sql) or die($db->error);
		return $squery;
	}

	public function tambah($noKTP, $nama, $asalNegara, $asalKota, $namaPerusahaan)
	{
		$db = $this->mysqli->conn;
		$db->query("INSERT INTO pelanggan VALUES('$noKTP','$nama','$asalNegara','$asalKota','$namaPerusahaan')") or die ($db->error);
		echo "<script>alert('Berhasil')</script>";
		echo "<script>location.replace('AdminDataPesanan.php')</script>";
	}
}
?>
