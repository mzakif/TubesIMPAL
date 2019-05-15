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
    include 'model/Transaksi.php';
    $trs = new Transaksi($connection);
?>
<ht
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!--Title-->
        <title>PT. Kereta Api</title>

        <!--Resvonsif CSS-->
        <link href="css/responsive/responsive.css" rel="stylesheet">

        <!-- Core Stylesheet -->
        <link href="style.css" rel="stylesheet">

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
                        <a href="AdminCekData.php">
                        <i class="fa fa-edit fa-lg"></i> Cek Transaksi
                        </a>
                    </li>
                    <li>
                        <a href="logout.php"><i class="fa fa-user"></i> logout</a>
                    </li>
                </ul>
            </div>
        </div>

    <!-- Header Area Start -->
        <header class="header_area consistance">
            <div class="container navbar-fixed-top">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#yummyfood-nav" aria-controls="yummyfood-nav" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars" aria-hidden="true"></i> Menu</button>

                            <!-- Menu Area Start -->
                            <div class="collapse navbar-collapse justify-content-center" id="yummyfood-nav">
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header Area End -->

        <!-- Form Pemesanan Area Start -->
        <div class="container col-6 formulir">
            <center>
                <h3 class="judulForm">PESANAN KERETA API</h3>
            </center>
            <!--Bagian Transaksi  -->
            <button type="button" class="btn btn-success active" data-toggle="modal" data-target="#tambah">Buat Pesanan Kereta</button>
            <div id="tambah" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah data</h4>
                  </div>
                  <form action="" method="post">
                    <div class="modal-body">
                      <div class="form-group">
                        <label class="control-label" for="idTransaksi">id Transaksi</label>
                        <input type="text" name="idTransaksi" class="form-control" id="idTransaksi" required>
                      </div>
                      <div class="form-group">
                        <label class="control-label" for="idPegawai">id Pegawai</label>
                        <input type="text" name="idPegawai" class="form-control" id="idPegawai" required>
                      </div>
                      <div class="form-group">
                        <label class="control-label" for="noKTP">no KTP</label>
                        <input type="text" name="noKTP" class="form-control" id="noKTP" required>
                      </div>
                      <div class="form-group">
                        <label class="control-label" for="idStock">jenis Kereta</label>
                        <input type="text" name="idStock" class="form-control" id="idStock" required>
                      </div>
                      <div class="form-group">
                        <label class="control-label" for="jumlah">jumlah</label>
                        <input type="text" name="jumlah" class="form-control" id="jumlah" required>
                      </div>
                      <div class="form-group">
                        <label class="control-label" for="tanggal">tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="tanggal" required>
                      </div>
                      <div class="form-group">
                        <label class="control-label" for="status">status</label></br>
                        <input type="radio" name="status" value="pending">pending</br>
                        <input type="radio" name="status" value="proses">proses</br>
                        <input type="radio" name="status" value="terjual">terjual</br>
                      </div>
                      <div class="modal-footer">
                        <button type="reset" class="btn btn-danger active" name="reset">reset</button>
                        <button type="submit" class="btn btn-success active" name="submit" value="submit">submit</button>
                      </div>
                    </div>
                  </form>
                  <?php
                  if (isset($_POST['submit'])) {
                    $idTransaksi = $connection->conn->real_escape_string($_POST['idTransaksi']);
                    $idPegawai = $connection->conn->real_escape_string($_POST['idPegawai']);
                    $noKTP = $connection->conn->real_escape_string($_POST['noKTP']);
                    $idStock = $connection->conn->real_escape_string($_POST['idStock']);
                    $jumlah = $connection->conn->real_escape_string($_POST['jumlah']);
                    $tanggal = $connection->conn->real_escape_string($_POST['tanggal']);
                    $status = $connection->conn->real_escape_string($_POST['status']);
                    $trs->tambah($idTransaksi, $idPegawai, $noKTP, $idStock, $jumlah, $tanggal,$status);
                  }
                  ?>
                </div>
              </div>
            </div>
          <!--akhir transaksi  -->
        </div>

    </body>
</html>
