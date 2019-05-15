<?php
$host = "localhost";
$user = "root";
$pass = "";
$database ="db_kereta";

$config = new mysqli("$host","$user","$pass","$database");

if ($config->connect_errno){
  echo "GAGAL LOGIN". $config->connect_error;
}
?>
