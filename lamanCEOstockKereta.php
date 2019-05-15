<!DOCTYPE html>
<?php
session_start();
$username = $_SESSION['username'];
if (empty($username)) {
  echo "<script> alert('Maaf anda harus login dahulu');window.location= 'login.php'; </script>";
}
require_once('model/config.php');
require_once('model/Database.php');

$connection = new Database($host, $user, $pass, $database);
include 'model/StockKereta.php';
$brg = new StockKereta($connection);
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CEO Blank</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="data.css">
    <!--DataTabel-->
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
    <!--Icon-->
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header" >
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li ><a href="lamanCEOstockKereta.php"><i class="fa fa-file"></i> Halaman Data StockKereta</a></li>
            <li ><a href="lamanCEOtransaksi.php"><i class="fa fa-file"></i> Halaman Data Transaksi</a></li>
            <li ><a href="lamanCEOpelanggan.php"><i class="fa fa-file"></i> Halaman Data Pelanggan</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#"><i class="fa fa-user"></i> Selamat Data CEO</a>
            </li>
            <li class="dropdown user-dropdown">
              <a href="logout.php"><i class="fa fa-user"></i> logout</a>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <!--tabel-->
      <div class="container-fluid" id="data">
       <h2>Data Stock Kereta Api</h2>
       <div class="table-responsive">
          <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID Stock Kereta</th>
              <th>ID Pegawai</th>
              <th>Nama Kereta</th>
              <th>Jenis Kereta</th>
              <th>Jumlah Kereta</th>
              <th>Harga Kereta</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $tampil = $brg->tampilStockKereta();
            while($data = $tampil->fetch_array()){
             ?>
             <tr>
               <td><?php echo $data['idStock']; ?></td>
               <td><?php echo $data['idPegawai']; ?></td>
               <td><?php echo $data['namaKereta']; ?></td>
               <td><?php echo $data['jenisKereta']; ?></td>
               <td><?php echo $data['jumlahKereta']; ?></td>
               <td><?php echo $data['hargaKereta']; ?></td>
             </tr>
             <?php
           }
              ?>
          </tbody>
          </table>
          </div>
          <a href="report/cetakdataStockKereta.php"  target="_blank">
          <button type="button" class="btn btn-default"><i class="fa fa-print"></i> cetak to excel </button>
          </a>
        </div>


      </div><!-- /#page-wrapper -->


    <!-- JavaScript -->

    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	  <script type="text/javascript" src="js/datatables.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
           $('#example').DataTable();
      } );
    </script>
  </body>
</html>
