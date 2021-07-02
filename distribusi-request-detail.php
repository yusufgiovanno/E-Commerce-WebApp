<?php
  session_start();
  $thisPage = "distribusi-request"; 
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

  <?php
  include 'session.php';
        
    $DistribusiID = $_GET['DistribusiID'];
    $queryDistribusi = mysqli_query($conn, "SELECT * FROM distribusi_products dp JOIN products p ON (dp.ProductID=p.ProductID) JOIN employees e ON(dp.To_Emp=e.EmployeeID) WHERE DistribusiID='$DistribusiID'") or die(mysql_error());

	while($updateDistribusi = mysqli_fetch_array($queryDistribusi)){
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
            <h1 class="h3 mb-0 text-gray-800">Request Detail</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row Untuk Menu Reveice Details -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
              
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Request Detail</h6>
            </div>
            
            <div class="container">
              <!-- Form -->
              <form action="cek-update-request.php?RequestID=<?php echo $DistribusiID;?>" method="POST">
                  
              <!-- Delivery ID -->
              <div class="row">
                <div class="col-25">
                  <label>Request ID</label>
                </div>
                <div class="col-75">
                  <input type="text" name="RequestID" placeholder="Masukkan No Pengiriman" readonly class="form-control" value="<?php echo $updateDistribusi['DistribusiID'];?>">
                </div>
              </div>
              
              <!-- Product Name -->
              <div class="row">
                <div class="col-25">
                  <label>Product Name</label>
                </div>
                <div class="col-75">
                  <input type="text" name="ProductName" placeholder="Masukkan Nama Produk" readonly class="form-control" value="<?php echo $updateDistribusi['ProductID'].' - '.$updateDistribusi['ProductName'];?>">
                </div>
              </div>
              
              <!-- Employee To -->
              <div class="row">
                <div class="col-25">
                  <label>To Employee</label>
                </div>
                <div class="col-75">
                  <input type="text" name="To_Emp" placeholder="Masukkan Nama Pengirim" readonly class="form-control" value="<?php echo $updateDistribusi['To_Emp'].' - '.$updateDistribusi['FirstName'].' '.$updateDistribusi['LastName'].' - '.$updateDistribusi['City'] ;?>">
                </div>
              </div>
              
              <!-- Qty Product -->
              <div class="row">
                <div class="col-25">
                  <label>Qty Product</label>
                </div>
                <div class="col-75">
                  <input type="number" name="Qty" min='0' placeholder="Masukkan Jumlah Barang" class="form-control" value="<?php echo $updateDistribusi['Qty'] ;?>">
                </div>
              </div>
              
              <!-- Cost Delivery -->
              <div class="row">
                <div class="col-25">
                  <label>Cost Delivery</label>
                </div>
                <div class="col-75">
                  <input type="number" name="Cost_Delivery" min='0' placeholder="Masukkan Biaya Pengiriman" readonly class="form-control" value="<?php echo $updateDistribusi['Cost_Delivery'] ;?>">
                </div>
              </div>
              
              <!-- Request Date -->
              <div class="row">
                <div class="col-25">
                  <label>Request Date</label>
                </div>
                <div class="col-75">
                  <input type="text" name="Request_Date" placeholder="Masukkan Tanggal Pengiriman" readonly class="form-control" value="<?php echo $updateDistribusi['Dist_Date'] ;?>">
                </div>
              </div>
			  
			  <!-- Status -->
              <div class="row">
                <div class="col-25">
                  <label>Status Delivery </label>
                </div>
                <div class="col-75">
                  <select id="Status" name="Status" class="form-control">
                    <option value="">Pilih Status Pengiriman</option>
                    <option value="Request" <?php echo ($updateDistribusi['Status']=='Request')?"selected":"";?>>Request</option>
                    <option value="Declain" <?php echo ($updateDistribusi['Status']=='Declain')?"selected":"";?>>Declain</option>
                    <option value="Cancel" <?php echo ($updateDistribusi['Status']=='Cancel')?"selected":"";?>>Cancel</option>
                  </select>
                </div>
              </div>
              
              <?php
	            }
	        ?>

              <!-- BUTTON -->
              <br><br>
              <div align="right">
                <button type="edit" name="edit" value="edit" class="btn btn-success">Simpan</button>
                <a href="distribusi-request.php" class="btn btn-danger">Kembali</a>
              </div>
              </form>
            </div>
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
          $("#kota").select2({
              placeholder: "Pilih Kota"
          });
      });
  </script>


</body>

</html>
