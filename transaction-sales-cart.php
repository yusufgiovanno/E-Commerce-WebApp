<?php
    session_start();
    $thisPage = "Transaction-Sales"; 
?>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php
        include 'head.php';
        ?>
    <script LANGUAGE="JavaScript">
        function tambah() {
            cek(); //panggil function cek
            a = eval(form.angka1.value); //mengisi variabel a dengan isi dari input name angka1
            b = eval(form.angka2.value); //mengisi variabel b dengan isi dari input name angka2
            c = a + b //menjumlahkan kedua variabel
            form.total.value = c; //memberikan hasil penjumlahan ke input name total
        }

        function kurang() {
            cek();
            a = eval(form.angka1.value);
            b = eval(form.angka2.value);
            c = a - b
            form.total.value = c;
        }

    </script>
</head>

<body id="page-top">

    <div id="scirptphp">
        <?php
            include 'session.php';

            class Item{
                var $id;
                var $name;
                var $unitprice;
                var $price;
                var $discount;
                var $quantity;
            }

            if (count($cart)==0){
                $_SESSION['next'] = 0;
            }
            $idPost = $_GET['id'];
            //$idPost = $_POST['id'];
            if(isset($_GET['id']) && !isset($_POST['update']))  {
                $sql = "SELECT se.ProductID, p.ProductName, se.UnitPrice, se.SalePrice, se.UnitsInStock FROM stckproductonemployee se JOIN products p ON(se.ProductID=p.ProductID) WHERE se.ProductID='$idPost' AND se.EmployeeID='$eid'";
                $result = mysqli_query($conn, $sql);
                $product = mysqli_fetch_object($result);
                
                $item = new Item();
                $item->id = $product->ProductID;
                $item->name = $product->ProductName;
                $item->unitprice = $product->UnitPrice;
                $item->price = $product->SalePrice;
                $item->discount = 0;  
                $item->quantity = 1;
                $iteminstock = $product->UnitsInStock;
                // Check product is existing in cart

                $cart = unserialize(serialize($_SESSION['cart'])); // set $cart as an array, unserialize() converts a string into array
                $jumlahChart=0;
                $jumlahChart = count($cart);
                $index = 0;
                for($i=0; $i<=count($cart)-1;$i++){  
                    if ($cart[$i]->id == $idPost){
                        $index = $i;
                        break;
                    }
                } 
                if($index == 0){
                    $_SESSION['cart'][] = $item; // $_SESSION['cart']: set $cart as session variable
                }
                else {
                    if (($cart[$index]->quantity) < $iteminstock){
                        $cart[$index]->quantity ++;
                        $_SESSION['cart'] = $cart;

                    }
                }

            }

            // Delete product in cart
            if(isset($_GET['index']) && !isset($_POST['update'])) {
                $cart = unserialize(serialize($_SESSION['cart']));
                unset($cart[$_GET['index']]);
                $cart = array_values($cart);
                $_SESSION['cart'] = $cart;
                $_SESSION['next'] = 1;
                $_SESSION['ongkir'] = 0;
            }
            // Update quantity in cart
            if(isset($_POST['update'])) {
                $arrQuantity = $_POST['quantity'];
                $disc = $_POST['diskon'];
                $cart = unserialize(serialize($_SESSION['cart']));
                for($i=0; $i<count($cart);$i++) {
                    $cart[$i]->quantity = $arrQuantity[$i];
                    $cart[$i]->discount = $disc[$i];
                }
                $_SESSION['ongkir'] = $_POST['ongkir'];
                $_SESSION['cart'] = $cart;
                $_SESSION['next'] = 1;
            }
            if(isset($_GET["id"]) || isset($_GET["index"])){
                header('Location: transaction-sales-cart.php');
            }

            ?>
    </div>

    <div id="wrapper">

        <?php include 'sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'topbar.php'; ?>
                <div class="container-fluid">
                    <!-- Letak Konten -->
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Keranjang Transaksi</h1>
                    </div>

                    <!-- Content Row Untuk Menu History Details -->

                    <!-- DataTales Example -->
                    <div id="load-history">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Keranjang Transaksi</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <form method="POST">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>ID Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Harga per Produk</th>
                                                    <th>Jumlah Barang</th>
                                                    <th>Diskon</th>
                                                    <th>Total Harga</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                    $cart = unserialize(serialize($_SESSION['cart']));
                                                    $s = 0;
                                                    $index = 0;
                                                    for($i=0; $i<count($cart); $i++){
                                                        $s += ($cart[$i]->price * $cart[$i]->quantity) - ($cart[$i]->discount);
                                                    ?>
                                                <tr>
                                                    <td><a href="transaction-sales-cart.php?index=<?php echo $index; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">
                                                            <span class="fa fa-trash"></span> Delete</a> </td>
                                                    <td> <?php echo $cart[$i]->id; ?> </td>
                                                    <td> <?php echo $cart[$i]->name; ?> </td>
                                                    <td align="right"> <?php echo number_format($cart[$i]->price); ?> </td>
                                                    <td>
                                                        <button type="button" id="sub" class="sub btn btn-info">-</button>
                                                        <input class="col-sm-4" type="text" value="<?php echo $cart[$i]->quantity; ?>" name="quantity[]" style="text-align: center;" />
                                                        <button type="button" id="add" class="add btn btn-info">+</button>
                                                    </td>
                                                    <td>
                                                        <input type="text" value="<?php echo $cart[$i]->discount;?>" name="diskon[]" style="text-align: right;">
                                                    </td>
                                                    <td align="right"> <?php echo number_format(($cart[$i]->price * $cart[$i]->quantity) - $cart[$i]->discount); ?> </td>
                                                </tr>
                                                <?php
                                                        $index++;
                                                    } ?>
                                                <tr>
                                                    <td colspan="6" style="text-align:right; font-weight:bold">Total<br>
                                                    </td>
                                                    <td align="right"> <?php echo number_format($s); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" style="text-align:right; font-weight:bold">Ongkos Kirim<br>
                                                    </td>
                                                    <td align="right">
                                                        <input type="text" name="ongkir" value="<?php echo $_SESSION['ongkir'];?>" style="text-align: right;" placeholder="0">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" style="text-align:right; font-weight:bold">Grand Total<br>
                                                        <button id="saveimg" name="update" class="btn btn-success"><span class="fa fa-shopping-cart"></span> Generate No. Nota</button>
                                                        <input type="hidden" name="update">
                                                    </td>
                                                    <td align="right"> <?php echo number_format($s + $_SESSION['ongkir']); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                    <a href="transaction-sales.php" class="btn btn-warning">
                                        <span class="fa fa-arrow-left"></span> Continue Shopping</a>

                                    <?php
                                        if (count($cart) != 0 && $_SESSION['next']==1){ ?>
                                    | <a href="transaction-sales-form-data.php" class="btn btn-primary">Next <span class="fa fa-arrow-right"></span></a>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </div>

    <?php include 'modal.php'; ?>

    <!--JavaSCript / JQuery-->
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script type="text/javascript">
        $('.add').click(function() {
            $(this).prev().val(+$(this).prev().val() + 1);
        });
        $('.sub').click(function() {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        });
    </script>
</body>

</html>
