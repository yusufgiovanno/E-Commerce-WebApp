<?php
session_start();
$thisPage = "dashboard"; 
?>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php
        include 'head.php';
        ?>
</head>

<body id="page-top">

    <div id="scirptphp">
        <?php
            include 'session.php';

            if($lv <= 2){
                $QueryJumlahTransaksi=mysqli_query($conn, "SELECT IF(COUNT(s.SalesID) IS NULL,0,COUNT(s.SalesID)) AS Total_Transaksi FROM sales s WHERE YEAR(SaleDate)=YEAR(CURRENT_DATE) ");
                $hasil=mysqli_fetch_array($QueryJumlahTransaksi);
                $CountSale = $hasil['Total_Transaksi'] ;

                $QueryItemTerjual=mysqli_query($conn, "SELECT IF(SUM(sd.Quantity) IS NULL,0,SUM(sd.Quantity)) AS Jumlah_Barang FROM sales s JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN employees e ON(s.EmployeeID=e.EmployeeID) WHERE YEAR(SaleDate)=YEAR(CURRENT_DATE) ");
                $hasil=mysqli_fetch_array($QueryItemTerjual);
                $SumProduct = $hasil['Jumlah_Barang'] ;

                $QueryTotalNominal=mysqli_query($conn, "SELECT IF(SUM(SubTotal-DiskonTransaksi) IS NULL,0,SUM(SubTotal-DiskonTransaksi)) AS Total_Nominal FROM sales s WHERE YEAR(SaleDate)=YEAR(CURRENT_DATE) ");
                $hasil=mysqli_fetch_array($QueryTotalNominal);
                $SumGrandTotalSale = $hasil['Total_Nominal'] ;
            } elseif($lv == 3){
                $QueryJumlahTransaksi=mysqli_query($conn, "SELECT IF(COUNT(s.SalesID) IS NULL,0,COUNT(s.SalesID)) AS Total_Transaksi FROM sales s WHERE (s.employeeID IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') or s.employeeID='$eid') AND YEAR(SaleDate)=YEAR(CURRENT_DATE) ");
                $hasil=mysqli_fetch_array($QueryJumlahTransaksi);
                $CountSale = $hasil['Total_Transaksi'] ;

                $QueryItemTerjual=mysqli_query($conn, "SELECT IF(SUM(sd.Quantity) IS NULL,0,SUM(sd.Quantity)) AS Jumlah_Barang FROM sales s JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN employees e ON(s.EmployeeID=e.EmployeeID) WHERE (s.employeeID IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') OR s.employeeID='$eid') AND YEAR(SaleDate)=YEAR(CURRENT_DATE) ");
                $hasil=mysqli_fetch_array($QueryItemTerjual);
                $SumProduct = $hasil['Jumlah_Barang'] ;

                $QueryTotalNominal=mysqli_query($conn, "SELECT IF(SUM(SubTotal-DiskonTransaksi) IS NULL,0,SUM(SubTotal-DiskonTransaksi)) AS Total_Nominal FROM sales s WHERE (s.employeeID IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') OR s.employeeID='$eid') AND YEAR(SaleDate)=YEAR(CURRENT_DATE) ");
                $hasil=mysqli_fetch_array($QueryTotalNominal);
                $SumGrandTotalSale = $hasil['Total_Nominal'] ;
            }else{
                $QueryJumlahTransaksi=mysqli_query($conn, "SELECT IF(COUNT(s.SalesID) IS NULL,0,COUNT(s.SalesID)) AS Total_Transaksi FROM sales s WHERE s.employeeID='$eid' AND YEAR(SaleDate)=YEAR(CURRENT_DATE) ");
                $hasil2=mysqli_fetch_array($QueryJumlahTransaksi);
                $CountSale = $hasil2['Total_Transaksi'] ;

                $QueryItemTerjual=mysqli_query($conn, "SELECT IF(SUM(sd.Quantity) IS NULL,0,SUM(sd.Quantity)) AS Jumlah_Barang FROM sales s JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN employees e ON(s.EmployeeID=e.EmployeeID) WHERE s.employeeID='$eid' AND YEAR(SaleDate)=YEAR(CURRENT_DATE) ");
                $hasil2=mysqli_fetch_array($QueryItemTerjual);
                $SumProduct = $hasil2['Jumlah_Barang'] ;

                $QueryTotalNominal=mysqli_query($conn, "SELECT IF(SUM(SubTotal-DiskonTransaksi) IS NULL,0,SUM(SubTotal-DiskonTransaksi)) AS Total_Nominal FROM sales s WHERE s.employeeID='$eid' AND YEAR(SaleDate)=YEAR(CURRENT_DATE) ");
                $hasil2=mysqli_fetch_array($QueryTotalNominal);
                $SumGrandTotalSale = $hasil2['Total_Nominal'] ;
            }
            ?>
    </div>

    <div id="wrapper">

        <?php include 'sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'topbar.php'; ?>
                <div class="container-fluid">
                    
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800" style="align-text:center">Have nice day,
                    <?=$nama?></h1>
                </div>
                    <div class="row">

                        <!-- TOTAL TRANSAKSI -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-sm font-weight-bold text-info text-uppercase mb-1">Transaksi</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800"><?=$CountSale?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-3x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TOTAL BARANG TERJUAL -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">BARANG TERJUAL</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800"><?=$SumProduct?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-boxes fa-3x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TOTAL TOTAL PENJUALAN -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-12">
                                            <div class="text-sm font-weight-bold text-danger text-uppercase mb-1">TOTAL PENJUALAN</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800">Rp.<?=number_format($SumGrandTotalSale)?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-3x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </div>

    <?php include 'modal2.php'; ?>


</body>

</html>
