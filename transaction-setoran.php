<?php
    session_start();
    $thisPage = "Transaction-Setoran"; 
?>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php
        include 'head.php';
        ?>
</head>

<body id="page-top">

    <?php include 'session.php'; ?>

    <div id="wrapper">

        <?php include 'sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'topbar.php'; ?>
                <div class="container-fluid">

                    <!-- Letak Konten -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">SETORAN</h1>
                    </div>

                    <!-- Content Row Untuk Menu History Details -->

                    <!-- DataTales Example -->
                    <div id="load-history">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Setoran</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Periode</th>
                                                <th>Employee</th>
                                                <th>Cash</th>
                                                <th>Basic Income</th>
                                                <th>Sale Income</th>
                                                <th>Setor</th>
                                                <th>Setor Date</th>
                                                <th>Input Setoran</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Periode</th>
                                                <th>Employee</th>
                                                <th>Cash</th>
                                                <th>Basic Income</th>
                                                <th>Sales Income</th>
                                                <th>Setor</th>
                                                <th>Setor Date</th>
                                                <th>Input Setoran</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php


                                                //if($lv <= 2){
                                                    $History = mysqli_query($conn, "SELECT CONCAT(YEAR(SaleDate),'-',MONTH(SaleDate)) AS Periode, e.EmployeeID, 
                                                                                    CONCAT(TitleOfCourtesy,'. ',firstname,' ',lastname) AS Nama_Employee, 
                                                                                    (SELECT sum(Debet_Jurnal-Kredit_Jurnal) FROM jurnal
                                                                                    WHERE MID(No_Perkiraan,1,4)='1000' AND 
                                                                                    IF(LENGTH(No_Perkiraan)=9,MID(No_Perkiraan,6,4),MID(No_Perkiraan,9,4))=e.EmployeeID AND
                                                                                    CONCAT(YEAR(Tanggal_Jurnal),'/', MONTH(Tanggal_Jurnal))=CONCAT(YEAR(s.SaleDate),'/',MONTH(s.SaleDate))) as Cash,
                                                                                    
                                                                                    (SELECT IF(SUM(SubTotal-DiskonTransaksi) IS NULL,0,SUM(SubTotal-DiskonTransaksi)) 
                                                                                    FROM sales s1 
                                                                                    WHERE s1.EmployeeID=e.EmployeeID AND 
                                                                                    CONCAT(YEAR(s1.SaleDate),'/',MONTH(s1.SaleDate))=CONCAT(YEAR(s.SaleDate),'/',MONTH(s.SaleDate))) +
                                                                                    
                                                                                    (SELECT IF(SUM(Tunai) IS NULL,0,SUM(Tunai)) 
                                                                                    FROM konsinasi k1 
                                                                                    WHERE k1.EmployeeID=e.EmployeeID AND 
                                                                                    CONCAT(YEAR(k1.KonsinasiDate),'/',MONTH(k1.KonsinasiDate))=CONCAT(YEAR(s.SaleDate),'/',MONTH(s.SaleDate))) AS NominalIncome,
                                                                                    
                                                                                    (SELECT IF(SUM(SubDasarTotal) IS NULL,0,SUM(SubDasarTotal))
                                                                                    FROM sales s1 
                                                                                    WHERE s1.EmployeeID=e.EmployeeID AND 
                                                                                    CONCAT(YEAR(s1.SaleDate),'/',MONTH(s1.SaleDate))=CONCAT(YEAR(s.SaleDate),'/',MONTH(s.SaleDate))) +
                                                                                    
                                                                                    (SELECT SUM(IF((Tunai = 0) OR (Tunai IS NULL),0,SubDasarTotal-NominalDasarReturn))  
                                                                                    FROM konsinasi k1 
                                                                                    WHERE k1.EmployeeID=e.EmployeeID AND 
                                                                                    CONCAT(YEAR(k1.KonsinasiDate),'/',MONTH(k1.KonsinasiDate))=CONCAT(YEAR(s.SaleDate),'/',MONTH(s.SaleDate))) AS NominalDasarIncome, 
                                                                                    
                                                                                    (SELECT IF(SUM(s1.Nominal) IS NULL,0,SUM(s1.Nominal))
                                                                                    FROM setoran s1 
                                                                                    WHERE s1.FromEmployeeID=e.EmployeeID AND 
                                                                                    s1.Periode=CONCAT(YEAR(s.SaleDate),'-',MONTH(s.SaleDate))) AS NominalSetoran,
                                                                                    
                                                                                    (SELECT s1.Setor_Date
                                                                                    FROM setoran s1 
                                                                                    WHERE s1.FromEmployeeID=e.EmployeeID AND 
                                                                                    s1.Periode=CONCAT(YEAR(s.SaleDate),'-',MONTH(s.SaleDate)) ORDER BY s1.Setor_Date desc) AS SetoranDate 
                                                                                    
                                                                                    FROM employees e LEFT JOIN  sales s ON (s.EmployeeID=e.EmployeeID) 
                                                                                    WHERE YEAR(SaleDate)=YEAR(CURRENT_DATE) AND e.EmployeeID='$eid'
                                                                                    ORDER BY Periode DESC, Nama_Employee ASC");

                                                /*} elseif($lv == 3){
                                                    $History = mysqli_query($conn, "SELECT CONCAT(YEAR(SaleDate),'-',MONTH(SaleDate)) AS Periode, e.EmployeeID, 
                                                                                    CONCAT(TitleOfCourtesy,'. ',firstname,' ',lastname) AS Nama_Employee, 
                                                                                    IF(COUNT(s.SalesID) IS NULL,0,COUNT(s.SalesID)) AS Total_Transaksi, 
                                                                                    IF(SUM(GrandTotalSale) IS NULL,0,SUM(GrandTotalSale)) AS Total_Nominal, 
                                                                                    IF(SUM(SubTotal) IS NULL,0,SUM(SubTotal)) AS SubTotal, 
                                                                                    IF(SUM(Biaya_Pengiriman) IS NULL,0,SUM(Biaya_Pengiriman)) AS Biaya_Pengiriman, 
                                                                                    IF(SUM(DiskonTransaksi) IS NULL,0,SUM(DiskonTransaksi)) AS DiskonTransaksi,
                                                                                    (select sum(Quantity) from sales_details sd1 JOIN sales s1 ON (sd1.SalesID=s1.SalesID) where s1.EmployeeID=e.EmployeeID AND CONCAT(YEAR(s1.SaleDate),'/',MONTH(s1.SaleDate))=CONCAT(YEAR(s.SaleDate),'/',MONTH(s.SaleDate))) as Sum_Qty
                                                                                    FROM employees e LEFT JOIN  sales s ON (s.EmployeeID=e.EmployeeID) 
                                                                                    WHERE (s.employeeID IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') OR s.employeeID='$eid') AND YEAR(SaleDate)=YEAR(CURRENT_DATE) 
                                                                                    GROUP BY Periode,e.EmployeeID 
                                                                                    ORDER BY Periode DESC");

                                                } else{
                                                    $History = mysqli_query($conn, "SELECT CONCAT(YEAR(SaleDate),'/',MONTH(SaleDate)) AS Periode, e.EmployeeID, CONCAT(TitleOfCourtesy,'. ',firstname,' ',lastname) AS Nama_Employee, IF(COUNT(s.SalesID) IS NULL,0,COUNT(s.SalesID)) AS Total_Transaksi, IF(SUM(GrandTotalSale) IS NULL,0,SUM(GrandTotalSale)) AS Total_Nominal, IF(SUM(SubTotal) IS NULL,0,SUM(SubTotal)) AS SubTotal, IF(SUM(Biaya_Pengiriman) IS NULL,0,SUM(Biaya_Pengiriman)) AS Biaya_Pengiriman, IF(SUM(DiskonTransaksi) IS NULL,0,SUM(DiskonTransaksi)) AS DiskonTransaksi FROM employees e LEFT JOIN  sales s ON (s.EmployeeID=e.EmployeeID) WHERE s.EmployeeID='$eid' and YEAR(SaleDate)=YEAR(CURRENT_DATE) GROUP BY Periode,e.EmployeeID ORDER BY Periode DESC, Nama_Employee ASC ");

                                                }*/
                                                while($dataHistory = mysqli_fetch_array($History)){
                                                    $Periode = $dataHistory['Periode'];
                                                    $id_pegawai = $dataHistory['EmployeeID'];
                                                    $Name = $dataHistory['Nama_Employee'];
                                                    $Cash= $dataHistory['Cash'];
                                                    $NominalIncome = $dataHistory['NominalIncome'];
                                                    $NominalDasarIncome = $dataHistory['NominalDasarIncome'];
                                                    $NominalSetoran = $dataHistory['NominalSetoran'];
                                                    $SetoranDate = $dataHistory['SetoranDate'];
                                                    
                                                    
                                                    

                                                ?>
                                            <tr>
                                                <td align="center"><?php echo $Periode; ?></td>
                                                <td align="center"><?php echo $id_pegawai.' - '.$Name; ?></td>
                                                <td align="right"><?php echo number_format($Cash); ?></td>
                                                <td align="right"><?php echo number_format($NominalDasarIncome); ?></td>
                                                <td align="right"><?php echo number_format($NominalIncome); ?></td>
                                                <td align="right"><?php echo number_format($NominalSetoran); ?></td>
                                                <td align="left"><?php echo $SetoranDate; ?></td>
                                                <td class="tools" align="center">
                                                    <?php if ($Cash > $NominalSetoran){
                                                    ?>
                                                    <a href="transaction-setoran-insert.php?Periode=<?php echo $Periode;?>&NominalDasarIncome=<?php echo $NominalDasarIncome;?>&username=<?php echo $username?>&cash=<?php echo $Cash?>" title="Input Setoran" class="btn btn-info">
                                                        
                                                    <?php } ?> <span class="fa fa-edit"></span>   Input Setoran</a>   
                                                </td>
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
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </div>

     <!-- Logout Modal-->
  <?php include 'modal3.php'; ?>


</body>

</html>
