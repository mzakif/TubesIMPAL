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
    include 'model/Pelanggan.php';
    $plg = new Pelanggan($connection);
?>
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


        <!-- Form Pemesanan Area Start -->
        <div class="container col-6 formulir">
            <center>
                <h3 class="judulForm">PELANGGAN KERETA API</h3>
            </center>
            <button type="button" class="btn btn-success active" data-toggle="modal" data-target="#tambahPelanggan">Buat Pelanggan</button>
            <div id="tambahPelanggan" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah data Pelanggan</h4>
                  </div>
                  <form action="" method="post">
                    <div class="modal-body">
                      <div class="form-group">
                        <label class="control-label" for="noKTP">no identitas</label>
                        <input type="text" name="noKTP" class="form-control" id="noKTP" required>
                      </div>
                      <div class="form-group">
                        <label class="control-label" for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" required>
                      </div>
                      <div class="form-group">
                        <label class="control-label" for="asalNegara">asal Negara</label>
                        <input type="text" name="asalNegara" class="form-control" id="asalNegara" required>
                      </div>
                      <div class="form-group">
                        <label class="control-label" for="asalKota">asal Kota</label>
                        <input type="text" name="asalKota" class="form-control" id="asalKota" required>
                      </div>
                      <div class="form-group">
                        <label class="control-label" for="namaPerusahaan">nama Perusahaan</label>
                        <input type="text" name="namaPerusahaan" class="form-control" id="namaPerusahaan" required>
                      </div>
                      <div class="modal-footer">
                        <button type="reset" class="btn btn-danger active" name="reset">reset</button>
                        <button type="submit" class="btn btn-success active" name="submit" value="submit">submit</button>
                      </div>
                    </div>
                  </form>
                  <?php
                  if (isset($_POST['submit'])) {
                    $noKTP = $connection->conn->real_escape_string($_POST['noKTP']);
                    $nama = $connection->conn->real_escape_string($_POST['nama']);
                    $asalNegara = $connection->conn->real_escape_string($_POST['asalNegara']);
                    $asalKota = $connection->conn->real_escape_string($_POST['asalKota']);
                    $namaPerusahaan = $connection->conn->real_escape_string($_POST['namaPerusahaan']);
                    $plg->tambah($noKTP, $nama, $asalNegara, $asalKota, $namaPerusahaan);
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
    </body>
</html>
