<?php
class Transaksi {

	private $mysqli;

	function __construct($conn){
		$this->mysqli = $conn;
	}

	public function tampilTransaksi(){
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM transaksi";
		$squery = $db->query($sql) or die($db->error);
		return $squery;
	}

	public function tambah($idTransaksi, $idPegawai, $noKTP, $idStock, $jumlah, $tanggal,$status)
	{
		$db = $this->mysqli->conn;
		$db->query("INSERT INTO transaksi VALUES('$idTransaksi','$idPegawai','$noKTP','$idStock','$jumlah','$tanggal','$status')") or die ($db->error);
		echo "<script>alert('Berhasil')</script>";
		echo "<script>location.replace('AdminDataPesanan.php')</script>";
	}
	public function edit($idTransaksi,$status){
		$db = $this->mysqli->conn;
		$db->query("UPDATE transaksi SET idTransaksi = '$idTransaksi', status = '$status' WHERE idTransaksi = '$idTransaksi'") or die ($db->error);
		echo "<script>alert('Berhasil')</script>";
		echo "<script>location.replace('ProduksiTransaksi.php')</script>";
	}
}
?>
