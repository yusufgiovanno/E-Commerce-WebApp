<?php
  session_start();
  $thisPage = "laporan-labarugi"; 
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

  <?php
  include 'session.php';
  $EmpID= $_GET['EmployeeID'];
  $Periode=$_GET['periode'];
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
            <h1 class="h3 mb-0 text-gray-800" style="align-text:center">Buku Besar Laba Rugi</h1>
            </div>
            
            
             <!-- Page Heading -->
            <div id="load-history">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Buku Besar Laba Rugi</h6>
              </div>
              <div class="card-body">
                <a href="laporan-labarugi.php" class="btn btn-danger"><span class="fa fa-arrow-left"></span> Back Laba Rugi</a>
                <br><br>
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                		<thead>
                			<tr>
                			    <th align="right">No Perkiraan</th>
                				<th align="right">Nama Perkiraan</th>
                				<th align="right">Debet</th>
                				<th align="right">Kredit</th>
                				<th align="right">MUTASI</th>
                				<th align="right">Buku Harian</th>
                			</tr>
                		</thead>
                		<tbody>
                			<?php 
                    			//$data = mysqli_query($conn,"SELECT YEAR(s.SaleDate) AS Tahun, DATE_FORMAT(s.SaleDate,'%b') AS Bulan, ProductName, SUM(Quantity) Qty_Sales, SUM(Quantity*SalePrice) AS Nominal FROM sales s JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN products p ON(sd.ProductID=p.ProductID) WHERE YEAR(s.SaleDate)=YEAR(CURRENT_DATE)  GROUP BY ProductName ORDER BY Tahun ASC, Bulan ASC");
                    		$TotalDebet=0;
                    		$TotalKredit=0;
                    		$Saldo=0;
                    		$data = mysqli_query($conn,"SELECT IF(LENGTH(j.No_Perkiraan)=9,MID(j.No_Perkiraan,1,4),MID(j.No_Perkiraan,1,7)) as No_Perkiraan2,
                                                        (SELECT Nama_Perkiraan FROM data_perkiraan dp WHERE dp.No_Perkiraan=(IF(LENGTH(j.No_Perkiraan)=9,MID(j.No_Perkiraan,1,4),MID(j.No_Perkiraan,1,7)))) as Nama_Perkiraan2,
                                                        sum(Kredit_Jurnal) as Kredit_Jurnal, sum(Debet_Jurnal) as Debet_Jurnal, sum(Kredit_Jurnal-Debet_Jurnal) as MUTASI,
                                                        IF(LENGTH(j.No_Perkiraan)=9,MID(j.No_Perkiraan,6,4),MID(j.No_Perkiraan,9,4)) as EmpID,
                                                        CONCAT(YEAR(j.Tanggal_Jurnal),'-', MONTH(j.Tanggal_Jurnal)) as Periode
                                                        FROM jurnal j
                                                        WHERE MID(j.No_Perkiraan,1,1)>=4 AND IF(LENGTH(j.No_Perkiraan)=9,MID(j.No_Perkiraan,6,4),MID(j.No_Perkiraan,9,4))='$EmpID' AND CONCAT(YEAR(j.Tanggal_Jurnal),'-', MONTH(j.Tanggal_Jurnal))='$Periode' GROUP BY j.No_Perkiraan ORDER BY j.No_Perkiraan ASC");
                                
                			while($d=mysqli_fetch_array($data)){
                			    $TotalDebet=$TotalDebet+$d['Debet_Jurnal'];
                    		    $TotalKredit=$TotalKredit+$d['Kredit_Jurnal'];
                    		    $Saldo=$TotalKredit-$TotalDebet;
                				?>
                				<tr>
                					<td align="right"><?php echo $d['No_Perkiraan2']; ?></td>
                					<td><?php echo $d['Nama_Perkiraan2']; ?></td>
                					<td align="Right"><?php echo number_format($d['Debet_Jurnal']); ?></td>
                					<td align="Right"><?php echo number_format($d['Kredit_Jurnal']); ?></td>
                					<td align="Right"><?php echo number_format($d['MUTASI']); ?></td>
                					<td class="tools" align="center"><a href="laporan-labarugi-details2.php?EmployeeID=<?php echo $d['EmpID'];?>&id=<?php echo $d['No_Perkiraan2'];?>&periode=<?php echo $d['Periode']?>" title="Lihat Buku Harian" class="btn btn-info">
                                                    <span class="fa fa-search"></span> Detail</a></td>
                				</tr>
                				<?php 
                    				
                    				
                    			} 
                    			
                			?>  
                			    <tfoot>
                                  <tr>
                                    <th align="right"></th>
                    				<th align="right"></th>
                    				<th align="Right"><?php echo number_format($TotalDebet);?></th>
                    				<th align="Right"><?php echo number_format($TotalKredit);?></th>
                    				<th align="Right"><?php echo number_format($Saldo);?></th>
                    				<th align="right"></th>
                                  </tr>
                                </tfoot>
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
  <?php include 'modal3.php'; ?>
  

</body>

</html>
