<?php
  session_start();
  $thisPage = "cash-in"; 
?>

<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <?php include 'head2.php'; ?>
    
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  
  <style>
      .select2-container {
        width: 100% !important;
      }
  </style>
  
</head>

<body id="page-top">

  <?php include 'session.php'; ?>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include 'topbar.php'; ?>
        <!-- End of Topbar -->
        
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">CASH IN</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
              
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Cash In</h6>
            </div>
            
            <div class="container">
              <!-- Form -->
              <form action="cek-insert-cash-in.php" method="POST">

              <!-- Jenis Cash In -->
              <div class="row">
                <div class="col-25">
                  <label>Type of Cash In<a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <select id="Type" name="Type" class="form-control">
                    <option value="">Pilih Jenis Arus Masuk Kas</option>
                    <option value="1">1 = Petty Cash </option>
                  </select>
                </div>
              </div> 
              
              <!-- Nominal -->
              <div class="row">
                <div class="col-25">
                  <label>Nominal <a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <input type="number" name="Nominal" placeholder="Masukkan Jumlah Nominal" min="0"class="form-control">
                </div>
              </div>
                  
              <!-- Keterangan -->
              <div class="row">
                <div class="col-25">
                  <label>Keterangan<a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <textarea name="Keterangan" placeholder="Masukkan Keterangan" class="form-control" cols="40" rows="6"></textarea>
                </div>
              </div>
              
              <!-- * -->
              <div class="row">
                <div class="col-25">
                </div>
                <div align="right" class="col-75">
                  <label><a style="color: red;">*</a> Wajib Diisi</label>
                </div>
              </div>

              <!-- BUTTON -->
              <br>
              <div align="right">
                <button type="save" name="save" value="save" class="btn btn-success">Simpan</button>
                <a href="cash-in.php" class="btn btn-danger">Kembali</a>
              </div>
              </form>
            </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include 'footer.php'; ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php include 'modal4.php'; ?>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- FITUR SELECT2 PADA Title -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#Type").select2({
              placeholder: "Pilih Jenis Arus Kas Masuk"
          });
      });
  </script>
  
  

</body>

</html>
