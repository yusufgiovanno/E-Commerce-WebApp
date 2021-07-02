<?php
session_start();
?>
<html lang="en">

<head>
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

                </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </div>

    <?php include 'modal.php'; ?>

    <!--JavaSCript / JQuery--!>
<!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


</body>

</html>
