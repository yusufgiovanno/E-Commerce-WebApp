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
  $No_Perkiraan= $_GET['id'];
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
            <h1 class="h3 mb-0 text-gray-800" style="align-text:center">Buku Harian Laba Rugi</h1>
            </div>
            
            
             <!-- Page Heading -->
            <div id="load-history">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Buku Harian Laba Rugi</h6>
              </div>
              <div class="card-body">
                <a href="laporan-labarugi-details.php?EmployeeID=<?php echo $EmpID;?>&periode=<?php echo $Periode?>" class="btn btn-danger"><span class="fa fa-arrow-left"></span> Back Buku Besar</a>
                <br><br>
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                		<thead>
                			<tr>
                			    <th align="right">Tanggal</th>
                				<th align="right">No Pekiraan</th>
                				<th align="right">Debet</th>
                				<th align="right">Kredit</th>
                				<th align="right">Keterangan</th>
                			</tr>
                		</thead>
                		<tbody>
                			<?php 
                    			//$data = mysqli_query($conn,"SELECT YEAR(s.SaleDate) AS Tahun, DATE_FORMAT(s.SaleDate,'%b') AS Bulan, ProductName, SUM(Quantity) Qty_Sales, SUM(Quantity*SalePrice) AS Nominal FROM sales s JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN products p ON(sd.ProductID=p.ProductID) WHERE YEAR(s.SaleDate)=YEAR(CURRENT_DATE)  GROUP BY ProductName ORDER BY Tahun ASC, Bulan ASC");
                    		$TotalDebet=0;
                    		$TotalKredit=0;
                    		$Saldo=0;
                    		$data = mysqli_query($conn,"SELECT Tanggal_Jurnal, No_Perkiraan,
                                                                IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4)) AS ID_Emp,
                                                                Kredit_Jurnal, Debet_Jurnal, Keterangan_Jurnal
                                                                FROM jurnal j
                                                                WHERE MID(No_Perkiraan,1,1)>=4 AND 
                                                                IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))='$EmpID' AND CONCAT(YEAR(j.Tanggal_Jurnal),'-', MONTH(j.Tanggal_Jurnal))='$Periode' AND
                                                                IF(LENGTH(j.No_Perkiraan)=9,MID(j.No_Perkiraan,1,4),MID(j.No_Perkiraan,1,7)) ='$No_Perkiraan'
                                                                ORDER BY Tanggal_Jurnal ASC ");
                                
                			while($d=mysqli_fetch_array($data)){
                			    $TotalDebet=$TotalDebet+$d['Debet_Jurnal'];
                    		    $TotalKredit=$TotalKredit+$d['Kredit_Jurnal'];
                    		    $Saldo=$TotalKredit-$TotalDebet;
                				?>
                				<tr>
                					<td align="right"><?php echo $d['Tanggal_Jurnal']; ?></td>
                					<td><?php echo $d['No_Perkiraan']; ?></td>
                					<td align="Right"><?php echo number_format($d['Debet_Jurnal']); ?></td>
                					<td align="Right"><?php echo number_format($d['Kredit_Jurnal']); ?></td>
                					<td><?php echo $d['Keterangan_Jurnal']; ?></td>
                					<!--<td class="tools" align="center"><a href="laporan-labarugi-detail.php?EmployeeID=<?php echo $d['ID_Emp'];?>&id=<?php echo $id_pegawai;?>&username=<?php echo $username?>" title="Lihat Detail History" class="btn btn-info">
                                                    <span class="fa fa-search"></span> Detail</a></td>-->
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
                    				<th align="right">SALDO : <?php echo number_format($Saldo);?></th>
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
