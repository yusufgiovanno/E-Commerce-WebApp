<?php
	session_start();
	$thisPage = "master-products"; 
?>

<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <?php include 'head.php'; ?>
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
            <h1 class="h3 mb-0 text-gray-800">Master Products</h1>
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div id="load-history">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Master Products</h6>
              </div>
              <div class="card-body">
                <a href="master-insert-produk.php" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah Produk</a>
                <br><br>
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>ID</th></th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <th>Sale Price</th>
                        <th>Unit Price</th>
                        <th>Picture</th>
                        <th>Active</th>
                        <th>Edit</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>ID</th></th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <th>Sale Price</th>
                        <th>Unit Price</th>
                        <th>Picture</th>
                        <th>Active</th>
                        <th>Edit</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php

                      // $dataHistory = mysql_query("SELECT * FROM history ORDER BY id_lampu");
                      $dataProduct = mysqli_query($conn, "SELECT ProductID, ProductName,  CategoryName, SalePrice, UnitPrice, Picture,Discontinued FROM products p JOIN categories c ON(p.CategoryID=c.CategoryID) ORDER BY ProductName ASC ");

                      while($Product = mysqli_fetch_array($dataProduct)){
                        $ProductID = $Product['ProductID'];
                        $ProductName = $Product['ProductName'];
                        $CategoryNama = $Product['CategoryName'];
                        $SalesPrice = $Product['SalePrice'];
                        $UnitPrice = $Product['UnitPrice'];
                        $Picture = $Product['Picture'];
                        $Discontinued =  $Product['Discontinued'];
                    ?>
                      <tr>
                        <td><?php echo $ProductID; ?></td>
                        <td><?php echo $ProductName; ?></td>
                        <td><?php echo $CategoryNama; ?></td>
                        <td align="right"><?php echo number_format($SalesPrice); ?></td>
                        <td align="right"><?php echo number_format($UnitPrice); ?></td>
                        <td align="center"><img class="card-img-top"  src="..\upload\<?php echo $Picture; ?>" alt="Card image cap" style="width:60px"><div><?php; ?></div></td>
                        <td class="tools" align="center">
                            <a onclick='javascript:confirmationUpdate($(this));return false;' href="updateDiscontinued.php?ProductID=<?php echo $ProductID;?>" title="<?php echo $Discontinued;?>" class="logo-lg">
                            <?php if ($Discontinued=='n'){?> <span class="logo-lg"><img src='img/On.png' alt='Discontinued' width="60px" height="30px"></span> <?php }else{?> <span class="logo-lg"><img src='img/Off.png' alt='Discontinued' width="60px" height="30px"></span> <?php }; ?>    
                        <span class="fa fa-refresh"></span></a></td>
                        <td class="tools" align="center">
                            <a href="master-update-produk.php?ProductID=<?php echo $ProductID;?>&username=<?php echo $username;?>" title="Klik untuk Update data Produk" class="btn btn-success">
                            <span class="fa fa-edit"></span> Update</a></td>
                        <!--?id_pegawai=<?php echo $id_pegawai;?>&username=<?php echo $username;?>-->
                      </tr>
                    <?php
                      }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
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

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Datatables js -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Datatables -->
  <script src="js/demo/datatables-demo.js"></script>
  <script>
        function confirmationUpdate(anchor)
        {
           var conf = confirm('Anda yakin untuk merubah status Active Product tersebut ?\nProses tersebut akan berpengaruh proses penjualan untuk Product tersebut');
           if(conf)
              window.location=anchor.attr("href");
        }
  </script>
</body>

</html>
