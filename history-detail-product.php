<?php
    $thisPage = "history-detail"; 
?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <?php include 'head2.php'; ?>
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this tables -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <?php
    include 'session2.php';
        
    $tanggal = $_GET['tanggal'];
    $id = $_GET['id'];
    $salesID=$_GET['salesID'];
    $username=$_GET['username'];
    $queryDetail = mysqli_query($conn, "SELECT s.SalesID,s.CustomerID, NAME, s.EmployeeID, FirstName, LastName,SaleDate, sd.ProductID, ProductName, Quantity, sd.UnitPrice, sd.OrderPrice,sd.Discount, GrandTotalSale, (Quantity*sd.OrderPrice)-sd.Discount as Total 
                                        FROM customers c JOIN sales s ON(c.CustomerID=s.CustomerID) JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN employees e ON(s.EmployeeID=e.EmployeeID) JOIN products p ON(sd.ProductID=p.ProductID) 
                                        WHERE s.salesID='$salesID' AND s.EmployeeID='$id'") or die(mysql_error());

    ?>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include 'sidebar2.php'; ?>
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
            <h1 class="h3 mb-0 text-gray-800">DETAIL PRODUCT HISTORY TRANSACTION</h1>
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div id="load-history">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Product History Transaction</h6>
              </div>
              <div class="card-body">
                <a href="history-detail.php?tanggal=<?php echo $tanggal;?>&id=<?php echo $id;?>&username=<?php echo $username?>" class="btn btn-danger"><span class="fa fa-arrow-left"></span> Back to History</a>
                <br><br>
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Date</th>
					    <th>Employee</th>
					    <th>Customer</th>
					    <th>Product</th>
					    <th>Qty</th>
					    <th>Price</th>
					    <th>Discount</th>
					    <th>Sub Total</th>
					    <th>Sick Details</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
						<th>Date</th>
					    <th>Employee</th>
					    <th>Customer</th>
					    <th>Product</th>
					    <th>Qty</th>
					    <th>Price</th>
					    <th>Discount</th>
					    <th>Sub Total</th>
					    <th>Sick Details</th>
                      </tr>
                    </tfoot>
                    <?php

                       
                        //   if($lv <= 2){
                        //         $History = mysqli_query($conn, "SELECT CONCAT(YEAR(SaleDate),'/',MONTH(SaleDate)) AS Periode, e.EmployeeID, CONCAT(TitleOfCourtesy,'. ',firstname,' ',lastname) AS Nama_Employee, IF(COUNT(s.SalesID) IS NULL,0,COUNT(s.SalesID)) AS Total_Transaksi, IF(SUM(GrandTotalSale) IS NULL,0,SUM(GrandTotalSale)) AS Total_Nominal FROM employees e LEFT JOIN  sales s ON (s.EmployeeID=e.EmployeeID) WHERE YEAR(SaleDate)=YEAR(CURRENT_DATE) GROUP BY Periode,e.EmployeeID ORDER BY Periode DESC, Nama_Employee ASC");
    
                        //     } elseif($lv == 3){
                        //         $History = mysqli_query($conn, "SELECT CONCAT(YEAR(SaleDate),'/',MONTH(SaleDate)) AS Periode, e.EmployeeID, CONCAT(TitleOfCourtesy,'. ',firstname,' ',lastname) AS Nama_Employee, IF(COUNT(s.SalesID) IS NULL,0,COUNT(s.SalesID)) AS Total_Transaksi, IF(SUM(GrandTotalSale) IS NULL,0,SUM(GrandTotalSale)) AS Total_Nominal FROM employees e LEFT JOIN  sales s ON (s.EmployeeID=e.EmployeeID) WHERE s.employeeID IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') OR s.employeeID='$eid' AND YEAR(SaleDate)=YEAR(CURRENT_DATE) GROUP BY Periode,e.EmployeeID ORDER BY Periode DESC");
                                
                        //     } else{
                        //         $History = mysqli_query($conn, "SELECT SalesID, e.EmployeeID, CONCAT(TitleOfCourtesy,'. ',firstname,' ',lastname) AS Nama_Employee, IF(COUNT(s.SalesID) IS NULL,0,COUNT(s.SalesID)) AS Total_Transaksi, IF(SUM(GrandTotalSale) IS NULL,0,SUM(GrandTotalSale)) AS Total_Nominal FROM employees e LEFT JOIN  sales s ON (s.EmployeeID=e.EmployeeID) WHERE s.EmployeeID='$eid' and YEAR(SaleDate)=YEAR(CURRENT_DATE) GROUP BY Periode,e.EmployeeID ORDER BY Periode DESC, Nama_Employee ASC ");
    
                        //     }
                        // $queryTanggal = mysqli_query($conn, "SELECT s.CustomerID, NAME, s.EmployeeID, FirstName, LastName,SaleDate, sd.ProductID, ProductName, 
                        //                                      Quantity, sd.UnitPrice, GrandTotalSale FROM customers c JOIN sales s ON(c.CustomerID=s.CustomerID) 
                        //                                      JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN employees e ON(s.EmployeeID=e.EmployeeID) 
                        //                                      JOIN products p ON(sd.ProductID=p.ProductID) WHERE CONCAT(YEAR(SaleDate),'/',MONTH(SaleDate))='$tanggal'")
                        //                                      or die(mysql_error());
                        $salesID        =array();
                        $CustomerID     =array();
                        $namaDepan      =array();
                        $namaBelakang   =array();
                        $nama_customer  =array();
                        $namaProduk     =array();
                        $jumlahBarang   =array();
                        $hargaBarang    =array();
                        $Discount       =array();
                        $totalBelanja   =array();
                        $i=0;
                        while($detailHistory = mysqli_fetch_array($queryDetail)){ 
                            $salesID[$i]                = $detailHistory['SalesID'];
                            $CustomerID[$i]             = $detailHistory['CustomerID'];
                            $namaDepan[$i]              = $detailHistory['FirstName'];
                            $namaBelakang[$i]           = $detailHistory['LastName'];
                       	    $nama_customer[$i]          = $detailHistory['NAME'];
                            $namaProduk[$i]             = $detailHistory['ProductName'];
                            $jumlahBarang[$i]           = $detailHistory['Quantity'];
                            $hargaBarang[$i]            = $detailHistory['OrderPrice'];
                            $Discount[$i]            = $detailHistory['Discount'];
                            $totalBelanja[$i]           = $detailHistory['Total'];
                            $i++;   
                          }
                          $arrlength = count($salesID);
                          for($i = 0; $i < $arrlength; $i++) {
                                $Note="Penyakit Customer: \\n"  ;
                                $queryDetail = mysqli_query($conn, "SELECT Sakit FROM detailsakit WHERE CustomerID='$CustomerID[$i]'") or die(mysql_error());
                                while($DetailSakit = mysqli_fetch_array($queryDetail)){
                                    $Sakit=$DetailSakit['Sakit'];
                                    $Note = "$Note @$Sakit\\n";
                                } 

                                ?>
                                   <tr>
                                    <td align="center"><?php echo $salesID[$i]; ?></td>
                                    <td align="left"><?php echo $namaDepan[$i] ." ". $namaBelakang[$i]; ?></td>
                                    <td align="left"><?php echo $nama_customer[$i]; ?></td>
                                    <td align="left"><?php echo $namaProduk[$i]; ?></td>
                                    <td align="right"><?php echo $jumlahBarang[$i]; ?></td>
                                    <td align="right"><?php echo number_format($hargaBarang[$i]); ?></td>
                                    <td align="right"><?php echo number_format($Discount[$i]); ?></td>
                                    <td align="right"><?php echo number_format($totalBelanja[$i]); ?></td>
                                    <td class="tools" align="center"><a href="#" 
                                            onclick="return alert('<?php echo $Note; ?>')" title="Lihat Sakit Customer" class="btn btn-info"> 
                                            <span class="fa fa-search"></span> Detail</a></td>
                                    <!--<td class="tools" align="center"><a href="detail-sakit.php?username=<?=$username?>" title="See Sick Details" class="btn btn-info">-->
                                    <!--<span class="fa fa-search"></span></a></td>-->
                                    </td>
                                   </tr>
                                <?php 
                          }
                        ?>
                    <tbody>
                    <!--Tempat data-->
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
  
</body>

</html>
