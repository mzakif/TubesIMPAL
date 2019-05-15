<?php
require_once('../model/config.php');
require_once('../model/Database.php');
include "../model/Transaksi.php";
$connection = new Database($host, $user, $pass, $database);
$brg = new Transaksi($connection);

$fileName = "Excel_Data_Transaksi-(".date('d-m-y').").xls";

header("Content-Disposition: attachment; filename='$fileName'");
header("Content-Type: application/vnd.ms-excel");
?>

<table border="1px">
  <tr>
    <h4 align=center> Data Transaksi </h4>
    <th>ID Transaksi</th>
    <th>ID Pegawai</th>
    <th>Nomer KTP</th>
    <th>ID Stock</th>
    <th>Jumlah</th>
    <th>Tanggal</th>
  </tr>
  <?php
  $tampil = $brg->tampilTransaksi();
  while ($data = $tampil->fetch_object()) {
    echo "<tr>";
    echo "<td align=center>".$data->idTransaksi."</td>";
    echo "<td align=center>".$data->idPegawai."</td>";
    echo "<td align=center>".$data->noKTP."</td>";
    echo "<td align=center>".$data->idStock."</td>";
    echo "<td align=center>".$data->jumlah."</td>";
    echo "<td align=center>".$data->tanggal."</td>";
    echo "</tr>";
    }
     ?>
</table>
