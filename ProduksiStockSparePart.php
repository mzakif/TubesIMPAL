<!DOCTYPE html>
<?php
session_start();
$username = $_SESSION['username'];
if (empty($username)) {
  echo "<script> alert('Maaf anda harus login dahulu');window.location= 'login.php'; </script>";
}
include 'model/config.php';
include 'model/Database.php';
$connection = new Database($host, $user, $pass, $database);
include 'model/Sparepart.php';
$brg = new Sparepart($connection);
if (@$_GET['act'] == '') {
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Div. Produksi</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="data.css">
    <!--DataTabel-->
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
    <!--Icon-->
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css">

    <!-- Add custom CSS here -->
    <link href="css/stProduksi.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav id="po" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
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
            <li ><a href="ProduksiStockSparePart.php"><i class="fa fa-file"></i> stock SparePart</a></li>
            <li ><a href="ProduksiTransaksi.php"><i class="fa fa-file"></i> Produksi</a></li>
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
       <h2>Data Stock SparePart</h2>
       <div class="table-responsive">
          <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID SparePart</th>
              <th>Nama SparePart</th>
              <th>Jumlah</th>
              <th>opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $tampil = $brg->tampilSparepart();
            while($data = $tampil->fetch_array()){
             ?>
             <tr>
               <td><?php echo $data['idSparepart']; ?></td>
               <td><?php echo $data['namaSpare']; ?></td>
               <td><?php echo $data['jumlah']; ?></td>
               <td align="center">
                 <a id="edit_stk" data-toggle="modal" data-target="#edit" data-idsk="<?php echo $data['idSparepart']; ?>" data-nama="<?php echo $data['namaSpare']; ?>" data-jumlah="<?php echo $data['jumlah']; ?>">
                   <button class="btn btn-primary"><i class="fa fa-edit"></i> edit </button>
                 </a>
                 <a href="?page=ProduksiStockSparePart&act=del&id=<?php echo $data['idSparepart']; ?>" onclick="return confirm('Yakin hapus data ini?')">
                 <button class="btn btn-danger"><i class="fa fa-trash-o"></i> hapus </button>
                 </a>
               </td>
             </tr>
             <?php
           }
              ?>
          </tbody>
          </table>
          </div>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah">tambah</button>
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
                      <label class="control-label" for="idSparepart">id Sparepart</label>
                      <input type="text" name="idSparepart" class="form-control" id="idSparepart" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label" for="namaSpare">nama SparePart</label>
                      <input type="text" name="namaSpare" class="form-control" id="namaSpare" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label" for="jumlah">jumlah</label>
                      <input type="number" name="jumlah" class="form-control" id="jumlah" required>
                    </div>
                    <div class="modal-footer">
                      <button type="reset" class="btn btn-danger" name="reset">reset</button>
                      <button type="submit" class="btn btn-success" name="submit" value="submit">submit</button>
                    </div>
                  </div>
                </form>
                <?php
                if (isset($_POST['submit'])) {
                  $idSparepart = $connection->conn->real_escape_string($_POST['idSparepart']);
                  $namaSpare = $connection->conn->real_escape_string($_POST['namaSpare']);
                  $jumlah = $connection->conn->real_escape_string($_POST['jumlah']);
                  $brg->tambah($idSparepart, $namaSpare, $jumlah);
                }
                ?>
              </div>
            </div>
          </div>
          <!-- Bagian edit -->
          <div id="edit" class="modal fade" role="dialog" >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit data</h4>
                </div>
                <form id="edit" method="post">
                  <div class="modal-body" id="edit_stks">
                    <div class="form-group">
                      <label class="control-label" for="idSparepart">id Sparepart</label>
                      <input type="text" name="idSparepart" class="form-control" id="idSparepart" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label" for="namaSpare">nama SparePart</label>
                      <input type="text" name="namaSpare" class="form-control" id="namaSpare" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label" for="jumlah">jumlah</label>
                      <input type="number" name="jumlah" class="form-control" id="jumlah" required>
                    </div>
                    <div class="modal-footer">
                      <button type="submit2" class="btn btn-success" name="edit" value="submit">submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <script src="js/jquery-1.10.2.js"></script>
          <script type="text/javascript">
          $(document).on("click", "#edit_stk", function(){
            var idstk = $(this).data('idsk');
            var nmstk = $(this).data('nama');
            var jmlstk = $(this).data('jumlah');
            $("#edit_stks #idSparepart").val(idstk);
            $("#edit_stks #namaSpare").val(nmstk);
            $("#edit_stks #jumlah").val(jmlstk);
          })
          </script>
          <?php
          if (isset($_POST['edit'])) {
            $idSparepart = $_POST['idSparepart'];
            $namaSpare = $_POST['namaSpare'];
            $jumlah = $_POST['jumlah'];
            $brg->edit($idSparepart, $namaSpare, $jumlah);
          }
          ?>
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
      });
    </script>

  </body>
</html>
<?php
}else if(@$_GET['act'] == 'del'){
  $brg->hapus($_GET['id']);
  header("location: ?page=ProduksiStockSparePart");
}
 ?>
