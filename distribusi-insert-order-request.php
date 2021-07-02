<?php
	session_start();
	$thisPage = "distribusi-order"; 
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
    <?php include 'sidebar.php'; 
    $OrderID = $_GET['OrderID'];
    ?>
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
            <h1 class="h3 mb-0 text-gray-800">Select Request to Order</h1>
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div id="load-history">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Request to Order</h6>
              </div>
              <div class="container">
              <!-- Form -->
              <form action="cek-insert-order.php" method="POST" enctype="multipart/form-data">
              <div class="card-body">
                <!--<a href="distribusi-insert-request.php" class="btn btn-primary"><span class="fa fa-plus"></span> Add Request Product to Order </a>-->
                <div class="container"> 
                      <div class="row">
                        <div class="col-25">
                          <label>Kode Order</label>
                        </div>
                        <div class="col-75">
                          <input type="text" name="OrderID" placeholder="Masukkan Kode Order" class="form-control" readonly="" value="<?php echo $OrderID;?>">
                        </div>
                      </div>
                  </div>
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th></th>
                        <th>From Emp</th>  
                        <th>Distribusi ID</th>
                        <th>Dist_Date</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Cost Delivery</th>
                        <th>Status</th>
                        <th>Update</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th></th>  
                        <th>From Emp</th>  
                        <th>Distribusi ID</th>
                        <th>Dist_Date</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Cost Delivery</th>
                        <th>Status</th>
                        <th>Update</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                      $no = 1;        
                      // $dataHistory = mysql_query("SELECT * FROM history ORDER BY id_lampu");
                      $dataDelivery = mysqli_query($conn, "SELECT DistribusiID, Dist_Date, dp.ProductID, ProductName, Qty, Cost_Delivery, From_Emp, Status, TitleOfCourtesy, FirstName, LastName, City
                                                           FROM distribusi_products dp JOIN employees e ON(dp.From_Emp=e.EmployeeID) JOIN products p ON(dp.ProductID=p.ProductID) 
                                                           WHERE Status IN ('Request')");

                      while($Delivery = mysqli_fetch_array($dataDelivery)){
                        $DistribusiID = $Delivery['DistribusiID'];
                        $Dist_Date = $Delivery['Dist_Date'];
                        $ProductID = $Delivery['ProductID'];
                        $ProductName = $Delivery['ProductID'].'-'.$Delivery['ProductName'];
                        $Qty = $Delivery['Qty'];
                        $Cost_Delivery = $Delivery['Cost_Delivery'];
                        $To_Emp = $Delivery['From_Emp'];
                        $Status = $Delivery['Status'];
                        $namaEmployee = $Delivery['From_Emp']. ' - '.$Delivery['TitleOfCourtesy']. '. ' .$Delivery['FirstName']. ' ' .$Delivery['LastName'].' - '.$Delivery['City'];
                    
                         
                    ?>
                      <tr>
                        <td><input type="checkbox" name="ID<?php echo $no; ?>" value="<?php echo $DistribusiID; ?>"></td>  
                        <td><?php echo $namaEmployee; ?></td>
                        <td><?php echo $DistribusiID; ?></td>
                        <td><?php echo $Dist_Date; ?></td>
                        <td><?php echo $ProductName; ?></td>
                        <td align="right"><?php echo number_format($Qty); ?></td>
                        <td align="right"><?php echo number_format($Cost_Delivery); ?></td>
                        <td class="tools" align="center">
                            <?php if ($Status=='Request'){
                                    ?> 
                                    <span class="logo-lg"><img src='img/Requesting.png' title="Request" alt='User Activity' width="50px" height="50px"></span> <?php 
                                    
                                }elseif ($Status=='Ordering'){
                                    ?> 
                                    <!--<a onclick='javascript:confirmationUpdate($(this));return false;' href="updateToRequest.php?DistribusiID=<?php echo $DistribusiID;?>&Status=<?php echo $Status;?>" title="<?php echo $Status;?>" class="logo-lg">-->
                                    <span class="logo-lg"><img src='img/Ordering.png' title="Ordering" alt='User Activity' width="50px" height="50px"></span> <?php 
                                    
                                }elseif ($Status=='Received Order'){
                                    ?> 
                                    <span class="logo-lg"><img src='img/Received_Order.png' title="Received Order" alt='User Activity' width="50px" height="50px"></span> <?php 
                                    
                                }elseif ($Status=='CancelRequest'){
                                    ?> 
                                    <span class="logo-lg"><img src='img/Received_Order.png' title="CancelRequest" alt='User Activity' width="50px" height="50px"></span> <?php 
                                }
                                ; ?>
                        
                        
                        <td class="tools" align="center">
                            <?php if (($Status=='Request')){?>
                            <a href="distribusi-insert-order-request-detail.php?DistribusiID=<?php echo $DistribusiID;?>&OrderID=<?php echo $OrderID;?>" title="Klik untuk Edit data Penerimaan" class="btn btn-info"> <?php }; ?> 
                        <span class="fa fa-edit"></span> Update</a></td> 
                      </tr>
                    <?php
                      $no++;
                      }
                    ?>
                    </tbody>
                  </table>
                  <input type="hidden" name="jumRequest" value="<?php echo $no-1; ?>" />
                </div>
                
              </div>
              <!-- BUTTON -->
              <br>
              <div align="right">
                <button type="save" name="save" value="save" class="btn btn-success">Save</button>
                <a href="distribusi-insert-order.php?OrderID=<?php echo $OrderID;?>" class="btn btn-danger">Back</a>
              </div>
              </form>
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
        function confirmationDelete(anchor)
        {
           var conf = confirm('Reset Password Menjadi Bioherbal@123 ?');
           if(conf)
              window.location=anchor.attr("href");
        }
        function confirmationUpdate(anchor)
        {
           var conf = confirm('Anda yakin untuk merubah status register user tersebut ?\nProses tersebut akan berpengaruh user tersebut dalam mengakses aplikasi ini');
           if(conf)
              window.location=anchor.attr("href");
        }
  </script>

</body>

</html>
