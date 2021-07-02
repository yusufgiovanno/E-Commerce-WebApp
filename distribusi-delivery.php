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
            <h1 class="h3 mb-0 text-gray-800">Delivery Product</h1>
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div id="load-history">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Delivery Product</h6>
              </div>
              <div class="card-body">
                <a href="distribusi-insert-delivery.php" class="btn btn-primary"><span class="fa fa-plus"></span> Add Delivery Product </a>
                <br><br>
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Distribusi ID</th>
                        <th>Dist_Date</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Cost Delivery</th>
                        <th>To_Emp</th>
                        <th>Receive_Date</th>
                        <th>Status</th>
                        <th>Update</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Distribusi ID</th>
                        <th>Dist_Date</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Cost Delivery</th>
                        <th>To_Emp</th>
                        <th>Receive_Date</th>
                        <th>Status</th>
                        <th>Update</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php

                      // $dataHistory = mysql_query("SELECT * FROM history ORDER BY id_lampu");
                      $dataDelivery = mysqli_query($conn, "SELECT DistribusiID, Dist_Date, dp.ProductID, ProductName, Qty, Cost_Delivery, To_Emp, Receive_Date, Status, TitleOfCourtesy, FirstName, LastName, City FROM distribusi_products dp JOIN employees e ON(dp.To_Emp=e.EmployeeID) JOIN products p ON(dp.ProductID=p.ProductID) WHERE dp.From_Emp='$eid' AND Status IN('Received','Return','OTW','ReturnAccepted','CancelDelivery') ");

                      while($Delivery = mysqli_fetch_array($dataDelivery)){
                        $DistribusiID = $Delivery['DistribusiID'];
                        $Dist_Date = $Delivery['Dist_Date'];
                        $ProductID = $Delivery['ProductID'];
                        $ProductName = $Delivery['ProductID'].'-'.$Delivery['ProductName'];
                        $Qty = $Delivery['Qty'];
                        $Cost_Delivery = $Delivery['Cost_Delivery'];
                        $To_Emp = $Delivery['To_Emp'];
                        $Receive_Date = $Delivery['Receive_Date'];
                        $Status = $Delivery['Status'];
                        $namaEmployee = $Delivery['To_Emp']. ' - '.$Delivery['TitleOfCourtesy']. '. ' .$Delivery['FirstName']. ' ' .$Delivery['LastName'].' - '.$Delivery['City'];
                    
                         
                    ?>
                      <tr>
                        <td><?php echo $DistribusiID; ?></td>
                        <td><?php echo $Dist_Date; ?></td>
                        <td><?php echo $ProductName; ?></td>
                        <td align="right"><?php echo number_format($Qty); ?></td>
                        <td align="right"><?php echo number_format($Cost_Delivery); ?></td>
                        <td><?php echo $namaEmployee; ?></td>
                        <td><?php echo $Receive_Date; ?></td>
                        <td class="tools" align="center">
                            <?php if ($Status=='OTW'){
                                    ?> 
                                    <a onclick='javascript:confirmationUpdate($(this));return false;' href="updateToDelivered.php?DistribusiID=<?php echo $DistribusiID;?>&Status=<?php echo $Status;?>" title="<?php echo $Status;?>" class="logo-lg">
                                    <span class="logo-lg"><img src='img/delivery.png' title="OTW" alt='User Activity' width="50px" height="30px"></span> <?php 
                                    
                                }elseif ($Status=='Received'){
                                    ?> <span class="logo-lg"><img src='img/Received.png' title="Received" alt='User Activity' width="50px" height="50px"></span> <?php 
                                    
                                }elseif ($Status=='Return'){
                                    ?> 
                                    <a onclick='javascript:confirmationUpdate($(this));return false;' href="updateToDelivered.php?DistribusiID=<?php echo $DistribusiID;?>&Status=<?php echo $Status;?>" title="<?php echo $Status;?>" class="logo-lg">
                                    <span class="logo-lg"><img src='img/Return.png' title="Return" alt='User Activity' width="50px" height="30px"></span> <?php 
                                    
                                }elseif ($Status=='ReturnAccepted'){
                                    ?> <span class="logo-lg"><img src='img/ReturnAccepted.png' title="ReturnAccepted" alt='User Activity' width="50px" height="50px"></span> <?php 
                                    
                                }elseif ($Status=='CancelDelivery'){
                                    ?> <span class="logo-lg"><img src='img/Cancel.png' title="Cancel Delivery" alt='User Activity' width="50px" height="50px"></span> <?php 
                                }; ?>
                        <span class="fa fa-refresh"></span></a></td>
                        
                        <td class="tools" align="center">
                            <?php if (($Status=='OTW') OR ($Status=='Return')){?>
                            <a href="distribusi-delivery-detail.php?DistribusiID=<?php echo $DistribusiID;?>" title="Klik untuk Edit data Penerimaan" class="btn btn-info"> <?php }; ?> 
                        <span class="fa fa-edit"></span> Update</a></td> 
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
