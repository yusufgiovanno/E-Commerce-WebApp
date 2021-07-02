<?php
  session_start();
  $thisPage = "distribusi-delivery"; 
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
            <h1 class="h3 mb-0 text-gray-800">Add Delivery Product</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
              
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Add Delivery Product</h6>
            </div>
            
            <div class="container">
              <!-- Form -->
              <form action="cek-insert-delivery.php" method="POST" enctype="multipart/form-data">
                  
              <!-- ID Produk -->
              <div class="row">
                <div class="col-25">
					<label>Product<a style="color: red;">*</label></a>
				 </div>
                <div class="col-75">
					<select id="Product" placeholder="Pilih Product" data-allow-clear="1" name="ProductID" class="form-control" required>
						<option></option>
						<?php
    						$sql = "SELECT se.ProductID, ProductName FROM stckproductonemployee se JOIN products p ON(se.ProductID=p.ProductID) WHERE se.Discontinued='n' AND se.EmployeeID='$eid' ORDER BY ProductName ASC";
    						$result = mysqli_query($conn, $sql);
    
    						if (mysqli_num_rows($result) > 0) {
    							// output data of each row
    							while($row = mysqli_fetch_assoc($result)) {
    								$ProductID = $row["ProductID"];
    								echo "<option value='$ProductID'>" . $row["ProductName"]. "</option>";
    							}
    						}
						?>

					</select>
				</div>
              </div>    
                
              <!-- Employee ID -->
              <div class="row">
                  <div class="col-25">
                      <label>Employee To<a style="color: red;">*</label></a>
                  </div>
                  <div class="col-75">
                      <select id="Employee" placeholder="Pilih Karyawan" data-allow-clear="1" name="EmployeeID" class="form-control">
                        <option></option>
                        <?php
                            $sql = "SELECT * FROM employees WHERE EmployeeID<>'$eid' AND EmployeeID<>'1101'";
                            
                            
                            $result = mysqli_query($conn, $sql);
        
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                    $EmployeeID = $row["EmployeeID"];
                                    echo "<option value='$EmployeeID'>" . $row["FirstName"]. " " . $row["LastName"] ." - ".$row["City"]."</option>";
                                }
                            }
                        ?>
    
                    </select>
                  </div>
              </div>
              
                            
              <!-- Qty -->
              <div class="row">
                <div class="col-25">
                  <label>Jumlah Barang<a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <input type="text" name="Qty" placeholder="Masukkan Jumlah Barang" class="form-control">
                </div>
              </div>
              
              <!-- Cost Delivery -->
              <!--<div class="row">
                <div class="col-25">
                  <label>Biaya Pengiriman<a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <input type="text" name="CostDelivery" placeholder="Masukkan Biaya Pengiriman" class="form-control">
                </div>
              </div>-->
              
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
                <button type="save" name="save" value="save" class="btn btn-success">Save</button>
                <a href="distribusi-delivery.php" class="btn btn-danger">Back</a>
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

  <!-- FITUR SELECT2 PADA PRODUCT -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#Product").select2({
              placeholder: "Pilih Product"
          });
      });
  </script>
  
  <!-- FITUR SELECT2 PADA EMPLOYEE -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#Employee").select2({
              placeholder: "Pilih Karyawan"
          });
      });
  </script>

</body>

</html>
