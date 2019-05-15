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
include 'model/Transaksi.php';
$brg = new Transaksi($connection);
if (@$_GET['act'] == '') {
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content
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
            <li ><a href="ProduksiStockSparepart.php"><i class="fa fa-file"></i> stock SparePart</a></li>
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
       <h2>Data Pesanan Kereta</h2>
       <div class="table-responsive">
          <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID Transaksi</th>
              <th>ID Pegawai</th>
              <th>Nomer KTP</th>
              <th>ID Stock</th>
              <th>Jumlah</th>
              <th>Tanggal</th>
              <th>status</th>
              <th>Tombol</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $tampil = $brg->tampilTransaksi();
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
               <td align="center">
                 <a id="edit_trs" data-toggle="modal" data-target="#edit" data-st="<?php echo $data['idTransaksi']; ?>"  >
                    <button class="btn btn-primary"><i class="fa fa-edit"></i> edit </button>
                 </a>
               </td>
             </tr>
             <?php
           }
              ?>
          </tbody>
          </table>
          </div>

          <div id="edit" class="modal fade" role="dialog" >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit data transaksi</h4>
                </div>
                <form id="edit" method="post">
                  <div class="modal-body" id="edit_trsk">
                    <div class="form-group">
                      <label class="control-label" for="idTransaksi">id Transaksi</label>
                      <input type="text" name="idTransaksi" class="form-control" id="idTransaksi" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label" for="status">status</label></br>
                      <input type="radio" name="status" value="pending">pending</br>
                      <input type="radio" name="status" value="proses">proses</br>
                      <input type="radio" name="status" value="terjual">terjual</br>
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
          $(document).on("click", "#edit_trs", function(){
            var idstk = $(this).data('st');
            $("#edit_trsk #idTransaksi").val(idstk);
          })
          </script>
          <?php
          if (isset($_POST['edit'])) {
            $idTransaksi = $_POST['idTransaksi'];
            $status = $_POST['status'];
            $brg->edit($idTransaksi,$status);
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
      } );
    </script>
  </body>
</html>
<?php
}else{

}
 ?>
