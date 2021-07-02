<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php include 'head.php'; ?>

    <!-- Select2 -->
    <link rel="stylesheet" href="css/select2.min.css" />

    <!-- Custom styles for this tables -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Script Auto Refresh -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js" type="text/javascript"></script>

    <!-- Script Js Google Maps -->
    <script src="http://maps.googleapis.com/maps/api/js"></script>

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
                        <h1 class="h3 mb-0 text-gray-800">Ganti Password</h1>
                    </div>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <div class="form-group">
                            <label>Password Lama:</label>
                            <input type="password" class="form-control" name="plama">
                        </div>
                        <div class="form-group">
                            <label>Password Baru:</label>
                            <input type="password" class="form-control" name="pbaru">
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password Baru:</label>
                            <input type="password" class="form-control" name="kpbaru">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                    <?php
                        if (isset($_POST['submit'])){
                            $pwd = $_SESSION['pwd'];
                            $ide = $_SESSION['eid'];
                            $plama = $_POST['plama'];
                            $pbaru = $_POST['pbaru'];
                            $kpbaru = $_POST['kpbaru'];
                            $sql = "UPDATE employees SET EmployeePassword=md5('$pbaru') WHERE EmployeeID='$ide'";

                            if ($pwd == $plama){
                                if ($pbaru == $kpbaru){
                                    if (mysqli_query($conn, $sql)){
                                        $_SESSION['pwd'] == $pbaru;
                                        try{
                                            //header("location:dashboard.php");
                                            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=dashboard.php">';
                                            
                                        } catch (Exception $e){
                                            echo "Password Berhasil Diperbarui.";
                                        }
                                    }
                                } else echo '<p style="color:red; align-text:center">Password Baru dan Lama Tidak Cocok.</p>';
                            } else {
                                echo '<p style="color:red; align-text:center">Password Lama Salah</p>';
                            }
                        }
                        ?>


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
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>


</body>

</html>
