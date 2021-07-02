<?php
session_start();
$thisPage = "Transaction-Sales"; 
?>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php
        include 'head.php';
    ?>
</head>

<body id="page-top">

    <?php
        include 'session.php';
        
        class Item{
            var $id;
            var $name;
            var $price;
            var $quantity;
        }
    ?>

    <div id="wrapper">

        <?php include 'sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'topbar.php'; ?>
                <div class="container-fluid">

                    <!-- Letak Konten -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Sales</h1>
                    </div>
                    
                    <div class="row">
                        <?php
                            include "dist/db.php";
                            
                            $ProductID      = array();
                            $Picture        = array();
                            $ProductName    = array();
                            $SalePrice      = array();
                            $c = 0;
                            $cart = unserialize(serialize($_SESSION['cart']));
                        
                            $sql = "SELECT se.ProductID, p.Picture, p.ProductName, se.SalePrice  FROM stckproductonemployee se JOIN products p ON (se.ProductID=p.ProductID) WHERE se.UnitsInStock != 0 AND se.Discontinued='n' AND se.EmployeeID='$eid'";
                            $result = mysqli_query($conn, $sql);
                        
                            while($product = mysqli_fetch_object($result)) {
                                $ProductID[$c]      = $product->ProductID;
                                $Picture[$c]        = $product->Picture;;
                                $ProductName[$c]    = $product->ProductName;
                                $SalePrice[$c]      = $product->SalePrice;
                                $c++;
                            }
                            for($i = 0; $i < $c; $i++){
                                $state = 1;
                                for ($j = 0; $j < count($cart); $j++){
                                    if ($cart[$j]->id == $ProductID[$i]){
                                        $state = 0;
                                    }
                                }
                                if ($state == 1){    

                            ?>

                        <div class="card" style="width: 9rem; margin-right: 10px; margin-top: 10px; margin-bottom: 10px;">
                            <img class="card-img-top" src="..\upload\<?php echo $Picture[$i] ?>" alt="Card image cap" style="height:150px">
                            <div class="card-body">
                                <h5 class="card-title" align="center"><?php echo $ProductName[$i]; ?></h5>
                                <p class="card-text" align="center">Rp. <?php echo number_format($SalePrice[$i]); ?></p>
                                <a href="transaction-sales-cart.php?id=<?php echo $ProductID[$i]; ?> &action=add" class="btn btn-info" style="float:right">Tambahkan Ke Keranjang</a>
                            </div>
                        </div>
                        <?php
                                }
                            }
                            ?>
                        
                    </div>
                </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </div>

    <?php include 'modal4.php'; ?>

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
