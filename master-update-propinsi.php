<?php
  session_start();
  $thisPage = "master-propinsi"; 
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
  <!--<link rel="stylesheet" href="css/select2.min.css"/>-->

</head>

<body id="page-top">

  <?php
    include 'session.php';
        
    $PropinsiID = $_GET['PropinsiID'];
    $queryPropinsi = mysqli_query($conn, "SELECT * FROM daftarpropinsi WHERE PropinsiID='$PropinsiID'") or die(mysql_error());

	while($updatePropinsi = mysqli_fetch_array($queryPropinsi)){
    ?>

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
            <h1 class="h3 mb-0 text-gray-800">Update Propinsi</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
              
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Update Propinsi</h6>
            </div>
            
            <div class="container">
              <!-- Form -->
              <form action="cek-update-propinsi.php?PropinsiID=<?php echo $PropinsiID;?>" method="POST">
                  
              <!-- Nama Propinsi -->
              <div class="row">
                <div class="col-25">
                  <label>Nama Propinsi</label>
                </div>
                <div class="col-75">
                  <input type="text" name="Propinsi" placeholder="Masukkan Nama Propinsi" class="form-control" value="<?php echo $updatePropinsi['Propinsi'];?>">
                </div>
              </div>

              <!-- Latitude -->
              <div class="row">
                <div class="col-25">
                  <label>Latitude</label>
                </div>
                <div class="col-75">
                  <input type="text" name="Latitude" placeholder="Masukkan Latitude Propinsi" class="form-control" value="<?php echo $updatePropinsi['Latitude'];?>">
                </div>
              </div>
              
              <!-- Longitude -->
              <div class="row">
                <div class="col-25">
                  <label>Longitude</label>
                </div>
                <div class="col-75">
                  <input type="text" name="Longitude" placeholder="Masukkan Longitude Propinsi" class="form-control" value="<?php echo $updatePropinsi['Longitude'];?>">
                </div>
              </div>
              <?php
	            }
	        ?>

              <!-- BUTTON -->
              <br><br>
              <div align="right">
                <button type="edit" name="edit" value="edit" class="btn btn-success">Simpan</button>
                <a href="master-propinsi.php" class="btn btn-danger">Kembali</a>
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

</body>

</html>
