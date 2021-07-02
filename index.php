<?php
    session_start();
    if ($_SESSION['status'] == "login"){
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=dashboard.php">';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <?php include 'head.php'; ?>
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">
  
  <!-- Cek Login -->
  <?php
    if(isset($_GET['pesan'])){
      if($_GET['pesan'] == "gagal"){
        die("
        <br><br><br><br>
        <div class='row justify-content-center'>
          <div class='col-xl-5 col-lg-12 col-md-9'>
            <div class='card o-hidden border-0 shadow-lg my-5'>
              <div class='card-body p-0'>
                <!-- Nested Row within Card Body -->
                <div class='row'>
                  <div class='col-lg-12'>
                    <div class='p-5'>
                      <div class='text-center'>
                        <h1 class='h4 text-gray-900 mb-4'>
                        Username atau Password Salah !
                        </h1>
                      </div>
                      
                      <a href='index.php' class='btn btn-danger btn-user btn-block'>
                      Login Kembali
                      </a> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
              ");
      }
      elseif($_GET['pesan'] == "sabar"){
        die("
        <br><br><br><br>
        <div class='row justify-content-center'>
          <div class='col-xl-5 col-lg-12 col-md-9'>
            <div class='card o-hidden border-0 shadow-lg my-5'>
              <div class='card-body p-0'>
                <!-- Nested Row within Card Body -->
                <div class='row'>
                  <div class='col-lg-12'>
                    <div class='p-5'>
                      <div class='text-center'>
                        <h1 class='h4 text-gray-900 mb-4'>
                        Account Anda masih menunggu konfirmasi Pimpinan !
                        </h1>
                      </div>
                      
                      <a href='index.php' class='btn btn-danger btn-user btn-block'>
                      Login Kembali
                      </a> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
              ");
      }
    }
  ?>



  <div class="container">
  <br><br><br>
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-5 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1><img src="img/Logo_Bio_Herbal_Kecil.png" width='70' height='70' /></h1>
                  </div>
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                  <form class="user" method="post" action="cek-login.php">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="username" placeholder="Masukkan Username" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" placeholder="Masukkan Password" required>
                    </div>
                    <!--<div class="form-group">-->
                    <!--  <div class="custom-control custom-checkbox small">-->
                    <!--    <input type="checkbox" class="custom-control-input" id="customCheck">-->
                    <!--    <label class="custom-control-label" for="customCheck">Remember Me</label>-->
                    <!--  </div>-->
                    <!--</div>-->
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  <a href="registrasi.php" class="btn btn-primary btn-user btn-block">Registrasi</a>
                  </form>
                  
                  <!--<hr>-->
                  <!--<div class="text-center">-->
                  <!--  <a class="small" href="forgot-password.html">Lupa Password?</a>-->
                  <!--</div>-->
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>
</html>