<?php
session_start();
$thisPage = "Transaction-Retur-Consinyasi"; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">


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
                    <form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Retur Consignment</h1>
                        </div>

                        <!-- Content Row Untuk Menu History Details -->

                        <!-- DataTales Example -->
                        <div id="load-history">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Detail Consignment</h6>
                                </div>

                                <div class="card-body">
                                    <!--<a href="master-insert-stock-awal.php" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah Produk</a>-->
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                            <thead>
                                                <tr>
                                                    <th>ID Detail Consignment</th>
                                                    <th>ID Consignment</th>
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Nominal</th>
                                                    <th>Qty Return</th>
                                                    <th>Nominal Return</th>
                                                    <th>Return Date</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>ID Detail Consignment</th>
                                                    <th>ID Consignment</th>
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Nominal</th>
                                                    <th>Qty Return</th>
                                                    <th>Nominal Return</th>
                                                    <th>Return Date</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>

                                                <?php
                                                    $cid = $_GET['ID'];
                                                    $c = 0;


                                                    $dataKons = mysqli_query($conn, "SELECT Konsinasi_Detail_ID, kd.Konsinasi_ID, kd.Product_ID, kd.EmployeeID, ProductName, Konsinasi_Qty, kd.UnitPrice, 
                                                            kd.Price_sales, kd.Discount, Return_Qty, ReturnDate 
                                                            FROM konsinasi_details kd JOIN stckproductonemployee spe ON (kd.Product_ID=spe.ProductID AND kd.EmployeeID=spe.EmployeeID)
                                                            JOIN products p ON (spe.ProductID=p.ProductID)
                                                            JOIN konsinasi k ON (kd.Konsinasi_ID=k.Konsinasi_ID)
                                                            WHERE kd.Konsinasi_ID='$cid'");    

                                                    while($Kons = mysqli_fetch_array($dataKons)){
                                                        $id = $Kons['Konsinasi_Detail_ID'];
                                                        $kid = $Kons['Konsinasi_ID'];
                                                        $prod = $Kons['Product_ID'];
                                                        $EmployeeID = $Kons['EmployeeID'];
                                                        $ProductName = $Kons['ProductName'];
                                                        $qty = $Kons['Konsinasi_Qty'];
                                                        $UnitPrice = $Kons['UnitPrice'];
                                                        $Price_sales = $Kons['Price_sales'];
                                                        $Discount = $Kons['Discount'];
                                                        $Return_Qty = $Kons['Return_Qty'];
                                                        $ReturnDate = $Kons['ReturnDate'];
                                                        $Nominal = (($qty * $Price_sales) - $Discount);
                                                    ?>
                                                <tr>
                                                    <td><?php echo $id; ?></td>
                                                    
                                                    <td><?php echo $kid; ?></td>
                                                    
                                                    <td><?php echo $prod . ' - ' . $ProductName; ?></td>
                                                    
                                                    <td align="right">
                                                        <?php echo $qty; ?>
                                                        <input type="hidden" id="Q<? echo $c; ?>" value="<?php echo $qty; ?>" >
                                                    </td>
                                                    
                                                    <td align="right">
                                                        <?php echo number_format($Nominal); ?>
                                                        <input type="hidden" id="N<? echo $c; ?>" value="<?php echo $Nominal; ?>" >
                                                    </td>
                                                    
                                                    <td align="right">
                                                    <input type="number" id="q<? echo $c; ?>" align="right" max="<? echo $qty; ?>" min="0">
                                                    </td>
                                                    
                                                    <td><p id="r<? echo $c; ?>"></p></td>
                                                    
                                                    <td><?php echo $ReturnDate; ?></td>
                                                </tr>
                                                <?php
                                                    $c++;
                                                    } 
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                        <a href="http://bioherbal.my.id/transaction-retur-consinyasi.php" class="btn btn-warning" style="float:left">Kembali</a>
                        <button name="submit" class="btn btn-success" style="float:right">Simpan</button>
                        <input type="button" class="btn btn-primary" style="float:right; margin-right:5px" onclick="hitung(<? echo $c; ?>)" value="Hitung">
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

    <!-- Hitung -->
    <script>
        function hitung(jumlah) {
            var i = 0;
            while (i < jumlah){
                var n = 'N' + i;
                var nom = document.getElementById(n).value; 

                var q = 'Q' + i;
                var qua = document.getElementById(q).value;

                var qt = 'q' + i;
                var qty = document.getElementById(qt).value;

                var id = 'r' + i;
                document.getElementById(id).innerHTML = qty * (nom / qua);   
                
                i++;
           }
    }
    </script>
    
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
    
    
</body>

</html>
