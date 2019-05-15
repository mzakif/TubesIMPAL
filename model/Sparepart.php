<?php
class Sparepart {
	private $mysqli;

	public function __construct($conn){

		$this->mysqli = $conn;
	}


	public function tampilSparepart(){
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM Sparepart";
		$squery = $db->query($sql) or die($db->error);
		return $squery;
	}
	public function tambah($idSparepart,$namaSpare,$jumlah)
	{
		$db = $this->mysqli->conn;
		$db->query("INSERT INTO sparepart VALUES('$idSparepart','$namaSpare','$jumlah')") or die ($db->error);
		echo "<script>alert('Berhasil')</script>";
    echo "<script>location.replace('ProduksiStockSparepart.php')</script>";
	}
	public function edit($idSparepart, $namaSpare, $jumlah){
		$db = $this->mysqli->conn;
		$db->query("UPDATE sparepart SET idSparepart = '$idSparepart', namaSpare = '$namaSpare', jumlah = '$jumlah' WHERE idSparepart = '$idSparepart'") or die ($db->error);
		echo "<script>alert('Berhasil')</script>";
    echo "<script>location.replace('ProduksiStockSparepart.php')</script>";
	}

	public function hapus($idSparepart){
		 $db = $this->mysqli->conn;
		 $db->query("DELETE FROM sparepart WHERE idSparepart = '$idSparepart'") or die ($db->error);
	}
}
?>
