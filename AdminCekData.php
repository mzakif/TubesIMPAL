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
include 'model/Transaksi.php';
$trk = new Transaksi($connection);
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PT Kereta Api</title>
    <!-- Core Stylesheet -->
    <link href="style.css" rel="stylesheet">
    <!--Resvonsif CSS-->
    <link href="css/responsive/responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="data.css">
    <!--DataTabel-->
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
    <!-- Jquery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap-4 js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins JS -->
    <script src="js/others/plugins.js"></script>
    <!-- Active JS -->
    <script src="js/active.js"></script>
  </head>
  <body>
    <div class="nav-side-menu">
        <div class="brand"><img class="foto" src="foto/logo.png" width="50%"></div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
            <div class="menu-list">
                <ul id="menu-content" class="menu-content collapse out">
                    <li>
                        <a href="AdminDataPelanggan.php">
                        <i class="fa fa-edit fa-lg"></i> Input Data Pelanggan
                        </a>
                    </li>
                    <li>
                        <a href="AdminDataPesanan.php">
                        <i class="fa fa-edit fa-lg"></i> Input Data Pesanan
                        </a>
                    </li>
                    <li>
                        <button class="btn-default" id = "buttonSH" onclick = "displayLoginBox()"><i class="fa fa-edit fa-lg" id = "buttonSH" onclick = "displayLoginBox()"></i>SH Kereta</button>
                    </li>
                    <li>
                        <button class="btn-default" id = "buttonSH2" onclick = "displayLoginBox()"><i class="fa fa-edit fa-lg" id = "buttonSH2" onclick = "displayLoginBox()"></i>SH Transaksi</button>
                    </li>
                    <li>
                        <a href="logout.php">
                        <i class="fa fa-edit fa-lg"></i>logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
<!--Batas  -->

        <div class="container-fluid col-6"  id="data">
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
          </div>
<!--  -->
          <div class="container-fluid col-6" id="data">
           <h2>Data Pesanan Kereta</h2>
           <div class="table-responsive">
              <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID Transaksi</th>
                  <th>ID Pegawai</th>
                  <th>Nomer KTP</th>
                  <th>ID Stock</th>
                  <th>Jumlah</th>
                  <th>Tanggal</th>
                  <th>status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $tampil = $trk->tampilTransaksi();
                while($data = $tampil->fetch_array()){
                 ?>
                 <tr>
                   <td><?php echo $data['idTransaksi']; ?></td>
                   <td><?php echo $data['idPegawai']; ?></td>
                   <td><?php echo $data['noKTP']; ?></td>
                   <td><?php echo $data['idStock']; ?></td>
                   <td><?php echo $data['jumlah']; ?></td>
                   <td><?php echo $data['tanggal']; ?></td>
                   <td><?php echo $data['status']; ?></td>
                 </tr>
                 <?php
               }
                  ?>
              </tbody>
              </table>
              </div>
            </div>

<!--  -->
          <!--Kereta  -->
          <script type="text/javascript">
            $(document).ready(function() {
                 $('#example').DataTable();
            } );
          </script>
          <!--btn SH kereta  -->
          <script type="text/javascript">
              $('#buttonSH').on('click', function(e){
              $("#example").toggle();
              $(this).toggleClass('class1')
            });
          </script>
          <!-- transaksi  -->
          <script type="text/javascript">
            $(document).ready(function() {
                 $('#example2').DataTable();
            } );
          </script>
          <!--btn SH transaksi  -->
          <script type="text/javascript">
              $('#buttonSH2').on('click', function(e){
              $("#example2").toggle();
              $(this).toggleClass('class1')
            });
          </script>
          <script src="js/jquery-1.10.2.js"></script>
          <script src="js/bootstrap.js"></script>
          <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
          <script type="text/javascript" src="js/datatables.min.js"></script>
  </body>
</html>
