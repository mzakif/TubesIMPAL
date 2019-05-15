<?php
require_once('../model/config.php');
require_once('../model/Database.php');
include "../model/StockKereta.php";
$connection = new Database($host, $user, $pass, $database);
$brg = new StockKereta($connection);

$fileName = "Excel_Data_StockKereta-(".date('d-m-y').").xls";

header("Content-Disposition: attachment; filename='$fileName'");
header("Content-Type: application/vnd.ms-excel");
?>

<table border="1px">
  <tr>
    <h4 align=center> Data StockKereta </h4>
    <th>ID Stock Kereta</th>
    <th>ID Pegawai</th>
    <th>Nama Kereta</th>
    <th>Jenis Kereta</th>
    <th>Jumlah Kereta</th>
    <th>Harga Kereta</th>
  </tr>
  <?php
  $tampil = $brg->tampilStockKereta();
  while ($data = $tampil->fetch_object()) {
    echo "<tr>";
    echo "<td align=center>".$data->idStock."</td>";
    echo "<td align=center>".$data->idPegawai."</td>";
    echo "<td align=center>".$data->namaKereta."</td>";
    echo "<td align=center>".$data->jenisKereta."</td>";
    echo "<td align=center>".$data->jumlahKereta."</td>";
    echo "<td align=center>".$data->hargaKereta."</td>";
    echo "</tr>";
    }
     ?>
</table>
