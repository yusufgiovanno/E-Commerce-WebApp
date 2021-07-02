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
    
    //---- Periode---------    
    $periode='';    
    if($lv <= 2){
        $queryPeriode = mysqli_query($conn, "SELECT DISTINCT CONCAT(YEAR(j.Tanggal_Jurnal),'-', MONTH(j.Tanggal_Jurnal)) AS Periode FROM jurnal j JOIN employees e ON(IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))=e.EmployeeID) WHERE YEAR(j.Tanggal_Jurnal)=YEAR(CURRENT_DATE) ORDER BY Periode ASC ");
    }
    elseif($lv == 3){
        $queryPeriode = mysqli_query($conn, "SELECT DISTINCT CONCAT(YEAR(j.Tanggal_Jurnal),'-', MONTH(j.Tanggal_Jurnal)) AS Periode FROM jurnal j JOIN employees e ON(IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))=e.EmployeeID) WHERE YEAR(j.Tanggal_Jurnal)=YEAR(CURRENT_DATE) AND IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4)) IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') OR IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))='$eid' ORDER BY Periode ASC  ");
    }
    else{
        $queryPeriode = mysqli_query($conn, "SELECT DISTINCT CONCAT(YEAR(j.Tanggal_Jurnal),'-', MONTH(j.Tanggal_Jurnal)) AS Periode FROM jurnal j JOIN employees e ON(IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))=e.EmployeeID) WHERE YEAR(j.Tanggal_Jurnal)=YEAR(CURRENT_DATE) AND IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))='$eid' ORDER BY Periode ASC  ");
    }
    $no =0;
    while ($dataPeriode = mysqli_fetch_array($queryPeriode)) {
        $periode=$periode . ",'" . $dataPeriode['Periode'] . "'";
        $xPeriode[$no]=$dataPeriode['Periode'];
        $no++;
    }
    
    //---- Employees--------- 
    $employee=array();
    $employeeID=array();
    if($lv <= 2){
        $queryEmployees = mysqli_query($conn, "SELECT DISTINCT e.EmployeeID, CONCAT(TitleOfCourtesy,'. ',FirstName,' ',LastName) AS EmployeeName FROM jurnal j JOIN employees e ON(IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))=e.EmployeeID) WHERE YEAR(Tanggal_Jurnal)=YEAR(CURRENT_DATE) AND level<=3 ORDER BY EmployeeName ASC ");
        //$queryEmployees = mysqli_query($conn, "SELECT DISTINCT e.EmployeeID, CONCAT(TitleOfCourtesy,'. ',FirstName,' ',LastName) AS EmployeeName FROM employees e WHERE level<=3 ORDER BY EmployeeName ASC ");
    }
    elseif($lv == 3){
        $queryEmployees = mysqli_query($conn, "SELECT DISTINCT e.EmployeeID, CONCAT(TitleOfCourtesy,'. ',FirstName,' ',LastName) AS EmployeeName FROM jurnal j JOIN employees e ON(IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))=e.EmployeeID)  WHERE YEAR(Tanggal_Jurnal)=YEAR(CURRENT_DATE) AND (IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4)) IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') OR IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))='$eid') ORDER BY EmployeeName ASC ");
    }
    else{
        $queryEmployees = mysqli_query($conn, "SELECT DISTINCT e.EmployeeID, CONCAT(TitleOfCourtesy,'. ',FirstName,' ',LastName) AS EmployeeName FROM jurnal j JOIN employees e ON(IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))=e.EmployeeID) WHERE YEAR(Tanggal_Jurnal)=YEAR(CURRENT_DATE) AND IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))='$eid' ORDER BY EmployeeName ASC ");
    }
    $no =0;
    //$employee[$no]  ="";
    //$employeeID[$no]=0; 
    //$no =1;
    while ($dataEmployees = mysqli_fetch_array($queryEmployees)) {
        $employee[$no]  =$dataEmployees['EmployeeName'];
        $employeeID[$no]=$dataEmployees['EmployeeID']; 
        $no++;
    }
    /*if ($lv <= 3){
        $employee[$no]='Total';
        $employeeID[$no]=0;
    }*/
    
    
    $warna=array();
    $warna[0]='50, 50, 50, 1';
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
    $warna[26]='153, 102, 255,0.2';
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
            <h1 class="h3 mb-0 text-gray-800" style="align-text:center">Laporan Laba Rugi</h1>
            </div>
            
            <div id="load-history">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Diagram Laporan Laba Rugi</h6>
              </div>
              <div class="card-body">
                
            	<div class="table-responsive">  
                    <canvas id="myChart" width="50%" height="25%"></canvas>
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
                                    $arrlength = count($employee);
                                    $Total = array();
                                    for($i = 0; $i < $arrlength; $i++) { 
                                        /*Mengitung total
                                        if ($employee[$i]=='Total')
                                        {   $xTotal=0;
                                            $arrlengthTotal = count($Total);
                                            for($x = 0; $x < $arrlengthTotal; $x++) { 
                                                $xTotal = $xTotal . ",'" . $Total[$x] . "'";
                                            }
                                            ?>
                                           {
                                                label: '<?php echo $employee[$i] ?>',
                                                data: [<?php echo $xTotal ?>],
                                                fill: false,
                                                backgroundColor: "rgba(<?php echo $warna[$i] ?>)",
                                                borderColor: "rgba(<?php echo $warna[$i] ?>)",
                                                pointHoverBackgroundColor: "rgba(<?php echo $warna[$i] ?>)",
                						        pointHoverBorderColor: "rgba(<?php echo $warna[$i] ?>)"
                                            } , <?php
                                        }
                                        else{*/
                                             $LR=0;
                                             $queryLR = mysqli_query($conn, "SELECT 
                                                                            CONCAT(YEAR(j.Tanggal_Jurnal),'-', MONTH(j.Tanggal_Jurnal)) AS Periode,
                                                                            IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4)) AS ID_Emp, 
                                                                            CONCAT(TitleOfCourtesy,'. ',FirstName,' ',LastName) AS EmployeeName,
                                                                            sum(Kredit_Jurnal-Debet_Jurnal) AS LR
                                                                            FROM jurnal j LEFT JOIN employees e ON(IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))=e.EmployeeID)
                                                                            WHERE MID(No_Perkiraan,1,1)>=4  AND YEAR(j.Tanggal_Jurnal)=YEAR(CURRENT_DATE) AND IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))='$employeeID[$i]'
                                                                            GROUP BY ID_Emp,Periode ORDER BY Periode ASC  ");
                                            
                                            $no =0;
                                            $SubTotal=0;
                                            while ($dataLR = mysqli_fetch_array($queryLR)) {
                                                while ($xPeriode[$no] != $dataLR['Periode']){
                                                    $Total[$no] = $Total[$no] + 0;
                                                    $SubTotal = $SubTotal + 0;
                                                    //$LR = $LR .",'0'" ;
                                                    $LR = $LR .",". $SubTotal ;
                                                    
                                    			    $no++;
                                                    
                                                }
                                                //$QtyJual = $QtyJual . ",'" . number_format($dataQtyProducts['Nominal'],0,',','.') . "'" ;
                                                $Total[$no] = $Total[$no] + $dataLR['LR'];
                                                $SubTotal = $SubTotal + $dataLR['LR'];
                                                //$LR = $LR . ",'" . $dataLR['LR'] . "'" ;
                                                $LR = $LR . "," . $SubTotal ;
                                                
                                                $no++;
                                            }
                                            if ($no < count($xPeriode)){
                                               for ($j=$no; $j < count($xPeriode);$j++){
                                                    $Total[$no] = $Total[$no] + 0;
                                                    $SubTotal = $SubTotal + 0;
                                                     //$LR = $LR .",0" ;
                                                    $LR = $LR .",". $SubTotal;
                                                     
                                                } 
                                            }?>
                                           {
                                                label: '<?php echo $employee[$i] ?>',
                                                data: [<?php echo $LR ?>],
                                                fill: false,
                                                backgroundColor: "rgba(<?php echo $warna[$i] ?>)",
                                                borderColor: "rgba(<?php echo $warna[$i] ?>)",
                                                pointHoverBackgroundColor: "rgba(<?php echo $warna[$i] ?>)",
                						        pointHoverBorderColor: "rgba(<?php echo $warna[$i] ?>)"
                                            } , <?php
                                        }    
                                    //} 
                                    ?>
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
                <h6 class="m-0 font-weight-bold text-primary">Tabel Laporan Pegawai</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                		<thead>
                			<tr>
                			    <th align="right">Periode</th>
                				<th align="right">Nama Pegawai</th>
                				<th align="right">Nominal Laba/Rugi</th>
                				<th align="right">Buku Besar</th>
                			</tr>
                		</thead>
                		<tbody>
                			<?php 
                    			//$data = mysqli_query($conn,"SELECT YEAR(s.SaleDate) AS Tahun, DATE_FORMAT(s.SaleDate,'%b') AS Bulan, ProductName, SUM(Quantity) Qty_Sales, SUM(Quantity*SalePrice) AS Nominal FROM sales s JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN products p ON(sd.ProductID=p.ProductID) WHERE YEAR(s.SaleDate)=YEAR(CURRENT_DATE)  GROUP BY ProductName ORDER BY Tahun ASC, Bulan ASC");
                    			if($lv <= 2){
                                    $data = mysqli_query($conn,"SELECT 
                                                                CONCAT(YEAR(j.Tanggal_Jurnal),'-', MONTH(j.Tanggal_Jurnal)) AS Periode,
                                                                IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4)) AS ID_Emp, 
                                                                CONCAT(TitleOfCourtesy,'. ',FirstName,' ',LastName) AS EmployeeName,
                                                                sum(Kredit_Jurnal-Debet_Jurnal) AS LR
                                                                FROM jurnal j JOIN employees e ON(IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))=e.EmployeeID)
                                                                WHERE MID(No_Perkiraan,1,1)>=4 AND YEAR(j.Tanggal_Jurnal)=YEAR(CURRENT_DATE) AND 
                                                                Level<=3 
                                                                GROUP BY ID_Emp,Periode ORDER BY Periode ASC ");
                                }
                                elseif($lv == 3){
                                    $data = mysqli_query($conn,"SELECT 
                                                                CONCAT(YEAR(j.Tanggal_Jurnal),'-', MONTH(j.Tanggal_Jurnal)) AS Periode,
                                                                IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4)) AS ID_Emp, 
                                                                CONCAT(TitleOfCourtesy,'. ',FirstName,' ',LastName) AS EmployeeName,
                                                                sum(Kredit_Jurnal-Debet_Jurnal) AS LR
                                                                FROM jurnal j JOIN employees e ON(IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))=e.EmployeeID)
                                                                WHERE MID(No_Perkiraan,1,1)>=4 AND YEAR(j.Tanggal_Jurnal)=YEAR(CURRENT_DATE) AND 
                                                                (IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4)) IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') OR IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))='$eid') 
                                                                GROUP BY ID_Emp,Periode ORDER BY Periode ASC ");
                                    /*$data = mysqli_query($conn,"SELECT YEAR(s.SaleDate) AS Tahun, DATE_FORMAT(s.SaleDate,'%b') AS Bulan, s.EmployeeID, CONCAT(TitleOfCourtesy,'. ',FirstName,' ',LastName) AS EmployeeName, SUM(Quantity) AS Qty_Sales, SUM(Quantity * sd.UnitPrice) AS Nominal FROM sales s JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN employees e ON (s.EmployeeID=e.EmployeeID) WHERE YEAR(s.SaleDate)=YEAR(CURRENT_DATE) AND 
                                                                (s.employeeID IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') OR s.employeeID='$eid') 
                                                                GROUP BY s.EmployeeID, Tahun, Bulan ORDER BY Tahun ASC, Bulan ASC, s.EmployeeID ASC");*/
                                }
                                else{
                                    $data = mysqli_query($conn,"SELECT 
                                                                CONCAT(YEAR(j.Tanggal_Jurnal),'-', MONTH(j.Tanggal_Jurnal)) AS Periode,
                                                                IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4)) AS ID_Emp, 
                                                                CONCAT(TitleOfCourtesy,'. ',FirstName,' ',LastName) AS EmployeeName,
                                                                sum(Kredit_Jurnal-Debet_Jurnal) AS LR
                                                                FROM jurnal j JOIN employees e ON(IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))=e.EmployeeID)
                                                                WHERE MID(No_Perkiraan,1,1)>=4 AND YEAR(j.Tanggal_Jurnal)=YEAR(CURRENT_DATE) AND IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))='$eid'
                                                                GROUP BY ID_Emp,Periode ORDER BY Periode ASC ");
                                }
                    			while($d=mysqli_fetch_array($data)){
                    				?>
                    				<tr>
                    					<td align="right"><?php echo $d['Periode']; ?></td>
                    					<td><?php echo $d['ID_Emp']." - ".$d['EmployeeName']; ?></td>
                    					<td align="Right"><?php echo number_format($d['LR']); ?></td>
                    					<td class="tools" align="center"><a href="laporan-labarugi-details.php?EmployeeID=<?php echo $d['ID_Emp'];?>&periode=<?php echo $d['Periode']?>" title="Lihat Buku Besar" class="btn btn-info">
                                                        <span class="fa fa-search"></span> Detail</a></td>
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
  <?php include 'modal3.php'; ?>
  

</body>

</html>
