<?php
class StockKereta {

	private $mysqli;

	function __construct($conn){
		$this->mysqli = $conn;
	}

	public function tampilStockKereta(){
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM stockkereta";
		$squery = $db->query($sql) or die($db->error);
		return $squery;
	}

}
?>
