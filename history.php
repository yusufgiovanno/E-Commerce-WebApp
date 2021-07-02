<?php
    session_start();
    $thisPage = "history"; 
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
                        <h1 class="h3 mb-0 text-gray-800">HISTORY TRANSACTION</h1>
                    </div>

                    <!-- Content Row Untuk Menu History Details -->

                    <!-- DataTales Example -->
                    <div id="load-history">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">History Transcation</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Employee ID</th>
                                                <th>Employee Name</th>
                                                <th>Count Transaction</th>
                                                <th>Qty Total</th>
                                                <th>Sub Total</th>
                                                <th>Discount</th>
                                                <th>Cost Delivery</th>
                                                <th>Grand Total</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Date</th>
                                                <th>Employee ID</th>
                                                <th>Employee Name</th>
                                                <th>Count Transaction</th>
                                                <th>Qty Total</th>
                                                <th>Sub Total</th>
                                                <th>Discount</th>
                                                <th>Cost Delivery</th>
                                                <th>Grand Total</th>
                                                <th>Detail</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php


                                                if($lv <= 2){
                                                    $History = mysqli_query($conn, "SELECT CONCAT(YEAR(SaleDate),'/',MONTH(SaleDate)) AS Periode, e.EmployeeID, 
                                                                                    CONCAT(TitleOfCourtesy,'. ',firstname,' ',lastname) AS Nama_Employee, 
                                                                                    IF(COUNT(s.SalesID) IS NULL,0,COUNT(s.SalesID)) AS Total_Transaksi, 
                                                                                    IF(SUM(GrandTotalSale) IS NULL,0,SUM(GrandTotalSale)) AS Total_Nominal, 
                                                                                    IF(SUM(SubTotal) IS NULL,0,SUM(SubTotal)) AS SubTotal ,
                                                                                    IF(SUM(Biaya_Pengiriman) IS NULL,0,SUM(Biaya_Pengiriman)) AS Biaya_Pengiriman, 
                                                                                    IF(SUM(DiskonTransaksi) IS NULL,0,SUM(DiskonTransaksi)) AS DiskonTransaksi,
                                                                                    (select sum(Quantity) from sales_details sd1 JOIN sales s1 ON (sd1.SalesID=s1.SalesID) where s1.EmployeeID=e.EmployeeID AND CONCAT(YEAR(s1.SaleDate),'/',MONTH(s1.SaleDate))=CONCAT(YEAR(s.SaleDate),'/',MONTH(s.SaleDate))) as Sum_Qty
                                                                                    FROM employees e LEFT JOIN  sales s ON (s.EmployeeID=e.EmployeeID) 
                                                                                    WHERE YEAR(SaleDate)=YEAR(CURRENT_DATE) 
                                                                                    GROUP BY Periode,e.EmployeeID 
                                                                                    ORDER BY Periode DESC, Nama_Employee ASC");

                                                } elseif($lv == 3){
                                                    $History = mysqli_query($conn, "SELECT CONCAT(YEAR(SaleDate),'/',MONTH(SaleDate)) AS Periode, e.EmployeeID, 
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

                                                }
                                                while($dataHistory = mysqli_fetch_array($History)){
                                                    $Tgl_Bulan = $dataHistory['Periode'];
                                                    $id_pegawai = $dataHistory['EmployeeID'];
                                                    $Name = $dataHistory['Nama_Employee'];
                                                    $TotalTransaksi = $dataHistory['Total_Transaksi'];
                                                    $TotalNominal = $dataHistory['Total_Nominal'];
                                                    $SubTotal = $dataHistory['SubTotal'];
                                                    $Biaya_Pengiriman = $dataHistory['Biaya_Pengiriman'];
                                                    $DiskonTransaksi = $dataHistory['DiskonTransaksi'];
                                                    $Sum_Qty = $dataHistory['Sum_Qty'];
                                                    
                                                    

                                                ?>
                                            <tr>
                                                <td align="center"><?php echo $Tgl_Bulan; ?></td>
                                                <td align="center"><?php echo $id_pegawai; ?></td>
                                                <td align="left"><?php echo $Name; ?></td>
                                                <td align="right"><?php echo $TotalTransaksi; ?></td>
                                                <td align="right"><?php echo $Sum_Qty; ?></td>
                                                <td align="right"><?php echo number_format($SubTotal); ?></td>
                                                <td align="right"><?php echo number_format($DiskonTransaksi); ?></td>
                                                <td align="right"><?php echo number_format($Biaya_Pengiriman); ?></td>
                                                <td align="right"><?php echo number_format($TotalNominal); ?></td>
                                                <td class="tools" align="center"><a href="history-detail.php?tanggal=<?php echo $Tgl_Bulan;?>&id=<?php echo $id_pegawai;?>&username=<?php echo $username?>" title="Lihat Detail History" class="btn btn-info">
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
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </div>

     <!-- Logout Modal-->
  <?php include 'modal3.php'; ?>


</body>

</html>
