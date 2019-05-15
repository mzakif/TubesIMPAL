<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="loginstyle.css">

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Load your Bootstrap JS Library Here -->
    <script src="js/bootstrap.js"></script>

    <title>Login</title>
  </head>
  <body>
    <div class="container">
     <form class="form-signin" action="" method="post">
        <div class="text-center mb-4">
          <img class="mb-4" src="foto/logo.png" alt="" width="100" height="100">
          <h1 class="h2 mb-3 font-weight-normal"></h1>
        </div>

        <div class="form-label-group">
          <input type="text" id="username" name="username" class="form-control" placeholder="username" required autofocus>
          <label for="username">username</label>
        </div>

        <div class="form-label-group">
          <input type="password" id="password" name="password" class="form-control" placeholder="password" required>
          <label for="password">password</label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" value="login" name="btnlogin" >Sign in</button>
      </form>

      <?php
      include 'model/config.php';
      if (isset($_POST['btnlogin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM login WHERE username = '$username' && password = '$password' ";

        $result = $config->query($query);

        $row = $result->num_rows;
        $sql = $config->query("SELECT * FROM login WHERE username = '$username' ");
        $akun = $sql->fetch_array();
        if ($row > 0) {
          if ($akun['level'] == "admin") {
            session_start();
            $_SESSION['username'] = $username;
            header("location: AdminDataPelanggan.php");
          }elseif ($akun['level'] == "CEO"){
            session_start();
            $_SESSION['username'] = $username;
            header("location: lamanCEOtransaksi.php");
          }elseif ($akun['level'] == "produksi") {
            session_start();
            $_SESSION['username'] = $username;
            header("location: ProduksiTransaksi.php");
          }
        }else {
          echo "<script>alert('Gagal login')</script>";
          echo "<script>location.replace('login.php')</script>";
        }
      }

       ?>

    </div>
  </body>
</html>
