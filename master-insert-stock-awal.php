<?php
session_start();
$thisPage = "master-stock-awal"; 
?>

<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include 'head2.php'; ?>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">

    <style>
        .select2-container {
            width: 100% !important;
        }

    </style>
    <script>
        $idEmp=0;
        $idBrg=0;
        function selectUser(str2) {
            if (str2 == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            }
            $idEmp=str2;
            if ($idBrg !="" )
            {
                xmlhttp.open("GET", "master-stock-awal-js.php?id=" + $idBrg + "&emp=" + str2, true);
                xmlhttp.send();
            }
        }
        
        function showUser(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            }
           
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            }
            $idBrg=str;
            if ($idEmp !="" )
            {
                xmlhttp.open("GET", "master-stock-awal-js.php?id=" + str + "&emp=" + $idEmp, true);
                //xmlhttp.open("GET", "master-stock-awal-js.php?id=" + str, true);
                xmlhttp.send();
            }
            
        }

    </script>
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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Stok Awal Produk</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row Untuk Menu History Details -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Stok Awal Produk</h6>
                        </div>

                        <div class="container">
                            <!-- Form -->
                            <form action="cek-insert-stock-awal.php" method="POST" enctype="multipart/form-data">

                                <!-- Employee ID -->
                                <div class="row">
                                    <div class="col-25">
                                        <label>Employee<a style="color: red;">*</a></label>
                                    </div>
                                    <div class="col-75">
                                        <select id="Employee" placeholder="Pilih Karyawan" data-allow-clear="1" name="EmployeeID" class="form-control" onchange="selectUser(this.value)" required>
                                            <option></option>
                                            <?php
                                                if($lv <= 2){
                                                    $sql = "SELECT * FROM employees WHERE Title<>'Admin'";
                                                }elseif($lv == 3){
                                                    $sql = "SELECT * FROM employees WHERE ((employeeID IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') or employeeID='$eid') AND employeeID<>'Admin')";
                                                }else{
                                                    $sql = "SELECT * FROM employees WHERE employeeID='$eid'";
                                                }

                                                $result = mysqli_query($conn, $sql);

                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while($row = mysqli_fetch_assoc($result)) {
                                                        $EmployeeID = $row["EmployeeID"];
                                                        echo "<option value='$EmployeeID'>" . $row["FirstName"]. " " . $row["LastName"] ."</option>";
                                                    }
                                                }
                                                ?>

                                        </select>
                                    </div>
                                </div>
                                
                                <!-- ID Produk -->
                                <div class="row">
                                    <div class="col-25">
                                        <label>Product<a style="color: red;">*</a></label>
                                    </div>
                                    <div class="col-75">
                                        <select id="Product" placeholder="Pilih Product" data-allow-clear="1" name="ProductID" class="form-control" onchange="showUser(this.value)" required>
                                            <option></option>
                                            <?php
                                                $sql = "SELECT * FROM products WHERE Discontinued='n' ORDER BY ProductName ASC";
                                                $result = mysqli_query($conn, $sql);

                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while($row = mysqli_fetch_assoc($result)) {
                                                        $ProductID = $row["ProductID"];
                                                        echo "<option value='$ProductID'>" . $row["ProductName"]. "</option>";
                                                    }
                                                }
                                                ?>

                                        </select>
                                    </div>
                                </div>

                                
                                
                                <div id="txtHint"></div>

                                <!-- Discount -->
                                <div class="row">
                                    <div class="col-25">
                                        <label>Diskon</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="number" name="Discon" placeholder="Masukkan Nilai Diskon" min="0" class="form-control">
                                    </div>
                                </div>

                                <!-- Unit In Stock -->
                                <div class="row">
                                    <div class="col-25">
                                        <label>Stok Awal<a style="color: red;">*</a></label>
                                    </div>
                                    <div class="col-75">
                                        <input type="number" name="UnitsInStock" placeholder="Masukkan Stok awal" min="0" class="form-control">
                                    </div>
                                </div>

                                <!-- * -->
                                <div class="row">
                                    <div class="col-25">
                                    </div>
                                    <div align="right" class="col-75">
                                        <label><a style="color: red;">*</a> Wajib Diisi</label>
                                    </div>
                                </div>

                                <!-- BUTTON -->
                                <br>
                                <div align="right">
                                    <button type="save" name="save" value="save" class="btn btn-success">Simpan</button>
                                    <a href="master-stock-awal.php" class="btn btn-danger">Kembali</a>
                                </div>
                            </form>
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

    <!-- FITUR SELECT2 PADA PRODUCT -->
    <script src="js/select/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#Product").select2({
                placeholder: "Pilih Product"
            });
        });

    </script>

    <!-- FITUR SELECT2 PADA EMPLOYEE -->
    <script src="js/select/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#Employee").select2({
                placeholder: "Pilih Karyawan"
            });
        });

    </script>
</body>

</html>
