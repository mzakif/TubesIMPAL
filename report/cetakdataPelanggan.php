<?php
require_once('../model/config.php');
require_once('../model/Database.php');
include "../model/Pelanggan.php";
$connection = new Database($host, $user, $pass, $database);
$brg = new Pelanggan($connection);

$fileName = "Excel_Data_Pelanggan-(".date('d-m-y').").xls";

header("Content-Disposition: attachment; filename='$fileName'");
header("Content-Type: application/vnd.ms-excel");
?>

<table border="1px">
  <tr>
    <h4 align=center> Data Pelanggan </h4>
    <th>Nomer KTP</th>
    <th>Nama Pelanggan</th>
    <th>Asal Negara</th>
    <th>Asal Kota</th>
    <th>Nama Perusahaan</th>
  </tr>
  <?php
  $tampil = $brg->tampilPelanggan();
  while ($data = $tampil->fetch_object()) {
    echo "<tr>";
    echo "<td align=center>".$data->noKTP."</td>";
    echo "<td align=center>".$data->nama."</td>";
    echo "<td align=center>".$data->asalNegara."</td>";
    echo "<td align=center>".$data->asalKota."</td>";
    echo "<td align=center>".$data->namaPerusahaan."</td>";
    echo "</tr>";
    }
     ?>
</table>
