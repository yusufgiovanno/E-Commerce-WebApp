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

  <?php include 'session.php'; 
        $OrderID = $_GET['OrderID']; 
        $ProductID = $_GET['ProductID']; 
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
            <h1 class="h3 mb-0 text-gray-800">DETAIL ORDER</h1>
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div id="load-history">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Order</h6>
              </div>
              <!-- BUTTON -->
                    
              <div class="card-body">
                  <a href="distribusi-insert-order.php?OrderID=<?php echo $OrderID;?>" class="btn btn-danger"><span class="fa fa-arrow-left"></span>Kembali</a>
                  <br>
                    <div class="container"> 
                    
                          <!-- Kode Order -->
                          <div class="row">
                            <div class="col-25">
                              <label>Kode Order</label>
                            </div>
                            <div class="col-75">
                              <input type="text" name="OrderID" placeholder="Masukkan Kode Order" class="form-control" readonly="" value="<?php echo $OrderID;?>">
                            </div>
                          </div>
                      
                  </div>  
                <!--<a href="distribusi-insert-order-request.php?OrderID=<?php echo $OrderID;?>" class="btn btn-primary"><span class="fa fa-plus"></span> Add Product From Request </a>
                <br><br>-->
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Request ID</th>
                        <th>Product</th>
                        <th>From Employee</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Sub Total</th>
                        <th>Discount</th>
                        <th>Cost Delivery</th>
                        <th>Grand Total</th>
                        <th>Status</th>
                        <!--<th>Update</th>-->
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Request ID</th>
                        <th>Product</th>
                        <th>From Employee</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Sub Total</th>
                        <th>Discount</th>
                        <th>Cost Delivery</th>
                        <th>Grand Total</th>
                        <th>Status</th>
                        <!--<th>Update</th>-->
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php

                      // $dataHistory = mysql_query("SELECT * FROM history ORDER BY id_lampu");
                      $dataOrders = mysqli_query($conn, "SELECT od.ProductID, ProductName, DistribusiID, od.EmployeeID, FirstName,LastName,
                                                            Quantity, OrderPrice, (Quantity*OrderPrice) AS SubTotal, DiskonTransaksi, od.Cost_Delivery, 
                                                            ((Quantity*OrderPrice)-DiskonTransaksi+od.Cost_Delivery) as GrandTotalOrder, od.Status_Order
                                                            FROM orders o JOIN order_details od ON(o.OrderID=od.OrderID) 
                                                            JOIN products p ON(p.ProductID=od.ProductID)
                                                            JOIN employees e ON(od.EmployeeID=e.EmployeeID)
                                                            where o.OrderID='$OrderID' AND od.ProductID='$ProductID' GROUP BY DistribusiID");

                      while($Orders = mysqli_fetch_array($dataOrders)){
                        $ProductID = $Orders['ProductID'];
                        $ProductName = $Orders['ProductID'] ."-".$Orders['ProductName'];
                        $DistribusiID = $Orders['DistribusiID'];
                        $EmployeeID = $Orders['EmployeeID'];
                        $EmpName = $Orders['FirstName'] . " " . $Orders['LastName'];
                        $Quantity = $Orders['Quantity'];
                        $OrderPrice = $Orders['OrderPrice'];
                        $SubTotal = $Orders['SubTotal'];
                        $DiskonTransaksi = $Orders['DiskonTransaksi'];
                        $Biaya_Pengiriman = $Orders['Cost_Delivery'];
                        $GrandTotalOrder = $Orders['GrandTotalOrder'];
                        $Status_Order = $Orders['Status_Order'];
                    
                         
                    ?>
                      <tr>
                        <td><?php echo $DistribusiID; ?></td>
                        <td><?php echo $ProductName; ?></td>
                        <td><?php echo $EmpName; ?></td>
                        <td align="right"><?php echo $Quantity; ?></td>
                        <td align="right"><?php echo number_format($OrderPrice); ?></td>
                        <td align="right"><?php echo number_format($SubTotal); ?></td>
                        <td align="right"><?php echo number_format($DiskonTransaksi); ?></td>
                        <td align="right"><?php echo number_format($Biaya_Pengiriman); ?></td>
                        <td align="right"><?php echo number_format($GrandTotalOrder); ?></td>
                        <td class="tools" align="center">
                            <?php if ($Status_Order=='Order'){
                                    ?> 
                                    <!--<a onclick='javascript:confirmationUpdate($(this));return false;' href="updateToDelivered.php?DistribusiID=<?php echo $DistribusiID;?>&Status=<?php echo $Status;?>" title="<?php echo $Status;?>" class="logo-lg">-->
                                    <span class="logo-lg"><img src='img/Ordering.png' title="Order" alt='User Activity' width="50px" height="50px"></span> <?php 
                                    
                                }elseif ($Status_Order=='Received'){
                                    ?> <span class="logo-lg"><img src='img/Received_Order.png' title="Received Order" alt='User Activity' width="50px" height="50px"></span> <?php 
                                    
                                }elseif ($Status_Order=='Request'){
                                    ?> <span class="logo-lg"><img src='img/Request.png' title="Received Order" alt='User Activity' width="50px" height="50px"></span> <?php 
                                    
                                }; ?>
                        
                        <!--<td class="tools" align="center">
                            <?php if (($Status_Order=='Request') OR ($Status_Order=='Order')){?>
                            <a href="distribusi-order-detail.php?OrderID=<?php echo $OrderID;?>" title="Klik untuk Edit data orders" class="btn btn-info"> <?php }; ?> 
                        <span class="fa fa-edit"></span> Update</a></td> -->
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