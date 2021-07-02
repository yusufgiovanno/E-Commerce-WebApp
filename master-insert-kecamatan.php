<?php
  session_start();
  $thisPage = "master-kecamatan";
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
            <h1 class="h3 mb-0 text-gray-800">Tambah Kecamatan</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
              
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tambah Kecamatan</h6>
            </div>
            
            <div class="container">
              <!-- Form -->
              <form action="cek-insert-kecamatan.php" method="POST">
                  
              <!-- Nama Kecamatan -->
              <div class="row">
                <div class="col-25">
                  <label>Nama Kecamatan</label>
                </div>
                <div class="col-75">
                  <input type="text" name="Kecamatan" placeholder="Masukkan Nama Kecamatan" class="form-control">
                </div>
              </div>
			  
			  <!-- Kota -->
			  <div class="row">
				 <div class="col-25">
					<label>Kota</label>
				 </div>
                <div class="col-75">
					<select id="kota" placeholder="Pilih Kota" data-allow-clear="1" name="KotaID" class="form-control">
						<option>Pilih Kota</option>
						<?php
    						$sql = "SELECT KotaID, Kota FROM daftarkota ORDER BY Kota";
    						$result = mysqli_query($conn, $sql);

    						if (mysqli_num_rows($result) > 0) {
    							// output data of each row
    							while($row = mysqli_fetch_assoc($result)) {
    								$KotaID = $row["KotaID"];
    								echo "<option value='$KotaID'>" . $row["Kota"]. "</option>";
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
                  <input type="text" name="Latitude" placeholder="Masukkan Latitude Kecamatan" class="form-control">
                </div>
              </div>
              
              <!-- Longitude -->
              <div class="row">
                <div class="col-25">
                  <label>Longitude</label>
                </div>
                <div class="col-75">
                  <input type="text" name="Longitude" placeholder="Masukkan Longitude Kecamatan" class="form-control">
                </div>
              </div>

              <!-- BUTTON -->
              <br><br>
              <div align="right">
                <button type="save" name="save" value="save" class="btn btn-success">Simpan</button>
                <a href="master-kecamatan.php" class="btn btn-danger">Kembali</a>
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin mau Logout?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">脳</span>
          </button>
        </div>
        <div class="modal-body">Tekan tombol "Logout" dibawah jika  sudah siap untuk mengakhiri sesi.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  
  <!-- FITUR SELECT2 PADA KOTA -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#kota").select2({
              placeholder: "Pilih Kota"
          });
      });
  </script>

</body>

</html>
