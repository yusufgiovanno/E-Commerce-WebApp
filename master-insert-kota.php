<?php
  session_start();
  $thisPage = "master-kota"; 
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
            <h1 class="h3 mb-0 text-gray-800">Tambah Kota</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
              
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tambah Kota</h6>
            </div>
            
            <div class="container">
              <!-- Form -->
              <form action="cek-insert-kota.php" method="POST">
                  
              <!-- Nama Kota -->
              <div class="row">
                <div class="col-25">
                  <label>Nama Kota</label>
                </div>
                <div class="col-75">
                  <input type="text" name="Kota" placeholder="Masukkan Nama Kota" class="form-control">
                </div>
              </div>
			  
			  <!-- Propinsi -->
			  <div class="row">
				 <div class="col-25">
					<label>Propinsi</label>
				 </div>
                <div class="col-75">
					<select id="propinsi" placeholder="Pilih Propinsi" data-allow-clear="1" name="PropinsiID" class="form-control">
						<option>Pilih Propinsi</option>
						<?php
    						$sql = "SELECT PropinsiID, Propinsi FROM daftarpropinsi ORDER BY Propinsi";
    						$result = mysqli_query($conn, $sql);
    
    						if (mysqli_num_rows($result) > 0) {
    							// output data of each row
    							while($row = mysqli_fetch_assoc($result)) {
    								$PropinsiID = $row["PropinsiID"];
    								echo "<option value='$PropinsiID'>" . $row["Propinsi"] . "</option>";
    							}
    						}
						?>

					</select>
				</div>
			  </div>
              
			  <!-- Latitude -->
              <div class="row">
                <div class="col-25">
                  <label>Latitude</label>
                </div>
                <div class="col-75">
                  <input type="text" name="Latitude" placeholder="Masukkan Latitude Kota" class="form-control">
                </div>
              </div>
              
              <!-- Longitude -->
              <div class="row">
                <div class="col-25">
                  <label>Longitude</label>
                </div>
                <div class="col-75">
                  <input type="text" name="Longitude" placeholder="Masukkan Longitude Kota" class="form-control">
                </div>
              </div>

              <!-- BUTTON -->
              <br><br>
              <div align="right">
                <button type="save" name="save" value="save" class="btn btn-success">Simpan</button>
                <a href="master-kota.php" class="btn btn-danger">Kembali</a>
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
  
  <!-- FITUR SELECT2 PADA KOTA -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#propinsi").select2({
              placeholder: "Pilih Propinsi"
          });
      });
  </script>

</body>

</html>
