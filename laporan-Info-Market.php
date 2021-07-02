<?php
  session_start();
  $thisPage = "laporan-Info-Market"; 
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
    
    //---- Periode---------    
    $periode='';    
    if($lv <= 2){
        $queryPeriode = mysqli_query($conn, "SELECT DISTINCT CONCAT(YEAR(s.SaleDate),'-', MONTH(s.SaleDate)) AS Periode FROM sales s JOIN employees e ON(s.EmployeeID=e.EmployeeID) WHERE YEAR(SaleDate)=YEAR(CURRENT_DATE) ORDER BY Periode ASC ");
    }
    elseif($lv == 3){
        $queryPeriode = mysqli_query($conn, "SELECT DISTINCT CONCAT(YEAR(s.SaleDate),'-', MONTH(s.SaleDate)) AS Periode FROM sales s JOIN employees e ON(s.EmployeeID=e.EmployeeID) WHERE YEAR(SaleDate)=YEAR(CURRENT_DATE) AND s.employeeID IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') OR s.EmployeeID='$eid' ORDER BY Periode ASC  ");
    }
    else{
        $queryPeriode = mysqli_query($conn, "SELECT DISTINCT CONCAT(YEAR(s.SaleDate),'-', MONTH(s.SaleDate)) AS Periode FROM sales s JOIN employees e ON(s.EmployeeID=e.EmployeeID) WHERE YEAR(SaleDate)=YEAR(CURRENT_DATE) AND s.EmployeeID='$eid' ORDER BY Periode ASC  ");
    }
    $no =0;
    while ($dataPeriode = mysqli_fetch_array($queryPeriode)) {
        $periode=$periode . ",'" . $dataPeriode['Periode'] . "'";
        $xPeriode[$no]=$dataPeriode['Periode'];
        $no++;
        
    }
    
    
    //---- Products--------- 
    $info=array();
    if($lv <= 2){
        $queryInfo = mysqli_query($conn, "SELECT DISTINCT if(UPPER(c.infoMarket)='RADIO',UPPER(InfoProgRadio),UPPER(c.infoMarket)) AS Info FROM sales s JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN products p ON(sd.ProductID=p.ProductID) JOIN customers c ON(c.CustomerID=s.CustomerID) WHERE YEAR(SaleDate)=YEAR(CURRENT_DATE) ORDER BY ProductName ASC ");
    }
    elseif($lv == 3){
        $queryInfo = mysqli_query($conn, "SELECT DISTINCT if(UPPER(c.infoMarket)='RADIO',UPPER(InfoProgRadio),UPPER(c.infoMarket)) AS Info FROM sales s JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN employees e ON(s.EmployeeID=e.EmployeeID) JOIN products p ON(sd.ProductID=p.ProductID) JOIN customers c ON(c.CustomerID=s.CustomerID) WHERE YEAR(SaleDate)=YEAR(CURRENT_DATE) AND (s.employeeID IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') OR s.EmployeeID='$eid') ORDER BY ProductName ASC ");
    }
    else{
        $queryInfo = mysqli_query($conn, "SELECT DISTINCT if(UPPER(c.infoMarket)='RADIO',UPPER(InfoProgRadio),UPPER(c.infoMarket)) AS Info FROM sales s JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN products p ON(sd.ProductID=p.ProductID) JOIN customers c ON(c.CustomerID=s.CustomerID) WHERE YEAR(SaleDate)=YEAR(CURRENT_DATE) AND s.EmployeeID='$eid' ORDER BY ProductName ASC ");
    }
    $no =0;
    while ($dataInfo = mysqli_fetch_array($queryInfo)) {
        $info[$no]  =$dataInfo['Info'];
        $no++;
    }
    $warna=array();
    $warna[0]='59, 100, 22, 1';
    $warna[1]='54, 162, 235, 1';
    $warna[2]='255, 99, 132, 1';
    $warna[3]='255, 206, 86, 1';
    $warna[4]='153, 102, 255, 1';
    $warna[5]='75, 192, 192, 1';
    $warna[6]='215, 59, 164, 1';
    $warna[7]='255, 159, 64, 1';
    $warna[8]='253, 202, 255, 1';
    $warna[9]='59, 255, 255, 1';
    $warna[10]='255, 59, 255, 1';
    $warna[11]='255, 255, 59, 1';
    $warna[12]='255, 255, 255, 1';
    
    $warna[13]='50, 100, 100, 0.7';
	$warna[14]='100, 50, 100, 0.7';
	$warna[15]='100, 100, 50, 0.7';
	$warna[16]='100, 100, 100, 0.7';
	$warna[17]='200, 100, 100, 0.7';
	$warna[18]='100, 200, 100, 0.7';
	$warna[19]='100, 100, 200, 0.7';
	$warna[20]='50, 50, 100, 0.7';
	$warna[21]='100, 50, 50, 0.7';
	$warna[22]='50, 100, 50, 0.7';
    
    $warna[23]='54, 162, 235, 0.2';
    $warna[24]='255, 99, 132, 0.2';
    $warna[25]='255, 206, 86, 0.2';
    $warna[26]='153, 102, 255, 0.2';
    $warna[27]='75, 192, 192, 0.2';
    $warna[28]='215, 59, 164, 0.2';
    $warna[29]='255, 159, 64, 0.2';
    $warna[30]='253, 202, 255, 0.2';
    $warna[31]='59, 255, 255, 0.2';
    $warna[32]='255, 59, 255, 0.2';
    $warna[33]='255, 255, 59, 0.2';
    $warna[34]='255, 255, 255, 0.2';
    $warna[35]='59, 100, 22, 0.2';
	
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
            <h1 class="h3 mb-0 text-gray-800" style="align-text:center">Laporan Info Market</h1>
            </div>
            
            <div id="load-history">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Diagram Laporan Info Market</h6>
              </div>
              <div class="card-body">
                <script src="Chart.bundle.js"></script>
                <style type="text/css">
                    .container {
                        width: 50%;
                        margin: 15px auto;
                    }
                </style>
            	<div class="table-responsive">  <!-- <div class="container"> -->
                    <canvas id="myChart" width="50%" height="35%"></canvas>
                </div>
                
            </div>
            	<br/>
            	<script>
                    var ctx = document.getElementById("myChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                                    labels: [<?php echo $periode ?>],
                                    datasets: [
                                    <?php 
                                    $arrlength = count($info);
                                    for($i = 0; $i < $arrlength; $i++) { 
                                         $QtyJual=0;
                                        if($lv <= 2){
                                            $queryQtyProducts = mysqli_query($conn, "SELECT CONCAT(YEAR(s.SaleDate),'-', MONTH(s.SaleDate)) AS Periode, SUM(Quantity) AS Qty_Sales FROM sales s JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN customers c ON(c.CustomerID=s.CustomerID) WHERE YEAR(s.SaleDate)=YEAR(CURRENT_DATE) AND (UPPER(infoMarket)='$info[$i]' OR UPPER(InfoProgRadio)='$info[$i]') GROUP BY Periode ORDER BY Periode ASC ");
                                        }
                                        elseif($lv == 3){
                                            $queryQtyProducts = mysqli_query($conn, "SELECT CONCAT(YEAR(s.SaleDate),'-', MONTH(s.SaleDate)) AS Periode, SUM(Quantity) AS Qty_Sales FROM sales s JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN customers c ON(c.CustomerID=s.CustomerID) JOIN employees e ON (s.EmployeeID=e.EmployeeID) WHERE YEAR(s.SaleDate)=YEAR(CURRENT_DATE) AND (s.employeeID IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') OR s.employeeID='$eid') AND (UPPER(infoMarket)='$info[$i]' OR UPPER(InfoProgRadio)='$info[$i]') GROUP BY Periode ORDER BY Periode ASC ");
                                        }
                                        else{
                                            $queryQtyProducts = mysqli_query($conn, "SELECT CONCAT(YEAR(s.SaleDate),'-', MONTH(s.SaleDate)) AS Periode, SUM(Quantity) AS Qty_Sales FROM sales s JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN customers c ON(c.CustomerID=s.CustomerID) WHERE YEAR(s.SaleDate)=YEAR(CURRENT_DATE) AND s.employeeID='$eid' AND (UPPER(infoMarket)='$info[$i]' OR UPPER(InfoProgRadio)='$info[$i]') GROUP BY Periode ORDER BY Periode ASC ");
                                        }
                                        $no =0;
                                        while ($dataQtyProducts = mysqli_fetch_array($queryQtyProducts)) {
                                            while ($xPeriode[$no] != $dataQtyProducts['Periode']){
                                                $QtyJual = $QtyJual .",0" ;
                                			    $no++;
                                            }
                                            $QtyJual = $QtyJual .",". $dataQtyProducts['Qty_Sales'] ;
                                			$no++;
                                        }
                                        if ($no < count($xPeriode)){
                                           for ($j=$no; $j < count($xPeriode);$j++){
                                                 $QtyJual = $QtyJual .",0" ;
                                            } 
                                        }
                                        
                                    
                                    ?>
                                       {
                                            label: '<?php echo $info[$i] ?>',
                                            data: [<?php echo $QtyJual ?>],
                                            fill: false,
                                            backgroundColor: "rgba(<?php echo $warna[$i] ?>)",
                                            borderColor: "rgba(<?php echo $warna[$i] ?>)",
                                            pointHoverBackgroundColor: "rgba(<?php echo $warna[$i] ?>)",
            						        pointHoverBorderColor: "rgba(<?php echo $warna[$i] ?>)"
                                        } , <?php
                                    } ?>
                                 ]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                            }
                        }
                    });
                </script>
            	<br/>
            	</div>
            	
            <!-- Page Heading -->
            <div id="load-history">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Laporan Info Market</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                		<thead>
                			<tr>
                				<th align="right">Tahun</th>
                				<th align="right">Bulan</th>
                				<th>Info Market/Program</th>
                				<th align="right">Qty Jual</th>
                			</tr>
                		</thead>
                		<tbody>
                			<?php 
                    			$no = 0;
                    			
                    			if($lv <= 2){
                                    $data = mysqli_query($conn,"SELECT YEAR(s.SaleDate) AS Tahun, DATE_FORMAT(s.SaleDate,'%b') AS Bulan, if(UPPER(c.infoMarket)='RADIO',UPPER(InfoProgRadio),UPPER(c.infoMarket)) AS Info, SUM(Quantity) AS Qty_Sales FROM sales s JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN customers c ON(c.CustomerID=s.CustomerID) WHERE YEAR(s.SaleDate)=YEAR(CURRENT_DATE) GROUP BY Info, Tahun, Bulan ORDER BY Tahun, Bulan ASC");
                                }
                                elseif($lv == 3){
                                    $data = mysqli_query($conn,"SELECT YEAR(s.SaleDate) AS Tahun, DATE_FORMAT(s.SaleDate,'%b') AS Bulan, if(UPPER(c.infoMarket)='RADIO',UPPER(InfoProgRadio),UPPER(c.infoMarket)) AS Info, SUM(Quantity) AS Qty_Sales FROM sales s JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN customers c ON(c.CustomerID=s.CustomerID) JOIN employees e ON (s.EmployeeID=e.EmployeeID) WHERE YEAR(s.SaleDate)=YEAR(CURRENT_DATE) AND (s.employeeID IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') OR s.employeeID='$eid') GROUP BY Info, Tahun, Bulan ORDER BY Tahun, Bulan ASC");
                                }
                                else{
                                    $data = mysqli_query($conn,"SELECT YEAR(s.SaleDate) AS Tahun, DATE_FORMAT(s.SaleDate,'%b') AS Bulan, if(UPPER(c.infoMarket)='RADIO',UPPER(InfoProgRadio),UPPER(c.infoMarket)) AS Info, SUM(Quantity) AS Qty_Sales FROM sales s JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN customers c ON(c.CustomerID=s.CustomerID) WHERE YEAR(s.SaleDate)=YEAR(CURRENT_DATE) AND s.employeeID='$eid' GROUP BY Info, Tahun, Bulan ORDER BY Tahun, Bulan ASC");
                                }
                    			while($d=mysqli_fetch_array($data)){
                    				?>
                    				<tr>
                    					<td align="right"><?php echo $d['Tahun']; ?></td>
                    					<td align="right"><?php echo $d['Bulan']; ?></td>
                    					<td><?php echo $d['Info']; ?></td>
                    					<td align="right"><?php echo $d['Qty_Sales']; ?></td>
                    					
                    				</tr>
                    				<?php 
                    				$no ++;
                    				
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
  <?php include 'modal3.php'; ?>
  

</body>

</html>
