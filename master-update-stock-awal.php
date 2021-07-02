<?php
  session_start();
  $thisPage = "master-stock-awal"; 
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
        
    $ProductID = $_GET['ProductID'];
    $EmployeeID= $_GET['EmployeeID'];
    $queryProduk = mysqli_query($conn, "SELECT sa.ProductID, p.ProductName, sa.EmployeeID, FirstName, LastName, sa.SalePrice, sa.UnitPrice, p.SalePrice AS SalePriceOri, p.UnitPrice AS UnitPriceOri, sa.Discon, sa.UnitsInStock, Level  
                                        FROM stckawalproductonemployee sa JOIN products p ON(sa.ProductID=p.ProductID) 
                                        JOIN employees e ON (e.EmployeeID=sa.EmployeeID)
                                        WHERE sa.ProductID='$ProductID' AND sa.EmployeeID='$EmployeeID'") or die(mysql_error());

	while($updateProduk = mysqli_fetch_array($queryProduk)){
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
            <h1 class="h3 mb-0 text-gray-800">Edit Stok Awal</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
              
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit Stok Awal</h6>
            </div>
            
            <div class="container">
              <!-- Form -->
              <form action="cek-update-stock-awal.php" method="POST" enctype="multipart/form-data">
              
              <!-- Produk ID -->
              <div class="row">
                <div class="col-25">
                  <label>Product ID</label>
                </div>
                <div class="col-75">
                  <input type="text" name="ProductID" placeholder="Masukkan Harga Jual" class="form-control" readonly value="<?php echo $updateProduk['ProductID'];?>">
                </div>
              </div>
              
              <!-- Produk Name -->
              <div class="row">
                <div class="col-25">
                  <label>Product Name</label>
                </div>
                <div class="col-75">
                  <input type="text" name="ProductName" placeholder="Masukkan Harga Jual" class="form-control" readonly value="<?php echo $updateProduk['ProductName'];?>">
                </div>
              </div>
              
              <!-- Employee ID -->
              <div class="row">
                <div class="col-25">
                  <label>Employee ID</label>
                </div>
                <div class="col-75">
                  <input type="text" name="EmployeeID" placeholder="Masukkan Harga Jual" class="form-control" readonly value="<?php echo $updateProduk['EmployeeID'];?>">
                </div>
              </div>
              
              <!-- Employee Name -->
              <div class="row">
                <div class="col-25">
                  <label>Employee Name</label>
                </div>
                <div class="col-75">
                  <input type="text" name="EmployeeName" placeholder="Masukkan Harga Jual" class="form-control" readonly value="<?php echo $updateProduk['FirstName'].' '.$updateProduk['LastName'];?>">
                </div>
              </div>
              
             <!-- Sale Price -->
              <div class="row">
                <div class="col-25">
                  <label>Harga Jual</label>
                </div>
                <div class="col-75">
                  <input type="number" name="SalePrice" placeholder="Masukkan Harga Jual" class="form-control" <?php  if ($updateProduk['Level']<=3){ ?> readonly <?php } ?> min="<?php echo $updateProduk['SalePriceOri'];?>" value="<?php echo $updateProduk['SalePrice'];?>">
                </div>
              </div>
              
              <!-- Unit Price -->
              <div class="row">
                <div class="col-25">
                  <label>Harga Barang</label>
                </div>
                <div class="col-75">
                  <input type="number" name="UnitPrice" placeholder="Masukkan Harga Barang" class="form-control" <?php  if ($updateProduk['Level']<=3){ ?> readonly <?php } ?> min="<?php echo $updateProduk['UnitPriceOri'];?>" value="<?php echo $updateProduk['UnitPrice'];?>">
                </div>
              </div>
              
              <!-- Discount -->
              <div class="row">
                <div class="col-25">
                  <label>Diskon</label>
                </div>
                <div class="col-75">
                  <input type="text" name="Discon" placeholder="Masukkan Nilai Diskon" class="form-control" value="<?php echo $updateProduk['Discon'];?>">
                </div>
              </div>
              
              <!-- Last Unit In Stock -->
              <div class="row">
                <div class="col-25">
                  <label>Last Stok Awal</label>
                </div>
                <div class="col-75">
                  <input type="text" name="LastUnitsInStock" placeholder="Masukkan Harga Jual" class="form-control" readonly value="<?php echo $updateProduk['UnitsInStock'];?>">
                </div>
              </div>
              
              <!-- Unit In Stock -->
              <div class="row">
                <div class="col-25">
                  <label>Stok Awal</label>
                </div>
                <div class="col-75">
                  <input type="text" name="UnitsInStock" placeholder="Masukkan Stok awal" class="form-control" value="<?php echo $updateProduk['UnitsInStock'];?>">
                </div>
              </div>
              
              <?php
	            }
	        ?>

              <!-- BUTTON -->
              <div align="right">
                <button type="edit" name="edit" value="edit" class="btn btn-success">Update</button>
                <a href="master-stock-awal.php" class="btn btn-danger">Kembali</a>
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

  <!-- FITUR SELECT2 PADA NAMA PRODUCTS -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#Products").select2({
              placeholder: "Pilih Nama Produk"
          });
      });
  </script>
  
  <!-- FITUR SELECT2 PADA NAMA EMPLOYEES -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#Employees").select2({
              placeholder: "Pilih Nama Pegawai"
          });
      });
  </script>

</body>

</html>
