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

    <?php include 'session.php'; ?>

    <div id="wrapper">

        <?php include 'sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'topbar.php'; ?>
                <div class="container-fluid">

                    <!-- Letak Konten -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Form Pembeli Lama</h1>
                    </div>

                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Pembeli Lama</h6>
                        </div>

                        <!-- Content Row Untuk Menu Dashboard -->
                        <div class="container">
                            <div class="row">

                                <div class="col-md-12">
                                    <h3>
                                        <center>Customer Baru</center>
                                    </h3>
                                    <a class="btn btn-success" href="transaction-consinyasi-form-data-new.php" style="margin-right:auto; margin-left:auto; display:block;">Registrasi Customer Baru</a>
                                    <br>
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                                        <h3>
                                            <center>Customer Lama</center>
                                        </h3>
                                        <div class="form-group">
                                            <label>Member</label>
                                            <select placeholder="Pilih Customer" data-allow-clear="1" name="idc" class="form-control" required>
                                                <option></option>
                                                <?php
                                                    $sql = "SELECT p.PropinsiID, Propinsi, kot.KotaID, Kota, kec.KecID, Kecamatan, kel.KelID, Kelurahan, c.CustomerID, Name FROM daftarpropinsi p JOIN daftarkota kot ON(p.PropinsiID=kot.PropinsiID) JOIN daftarkecamatan kec ON(kot.KotaID=kec.KotaID) JOIN daftar_kelurahan kel ON(kec.KecID=kel.KecID) JOIN customers c ON(kel.KelID = c.KelID)";
                                                    $result = mysqli_query($conn, $sql);

                                                    if (mysqli_num_rows($result) > 0) {
                                                        // output data of each row
                                                        while($row = mysqli_fetch_assoc($result)) {
                                                            $cid = $row["CustomerID"];
                                                            echo "<option value='$cid'>" . $row["Name"]. " - " . $row["Propinsi"]. " - " . $row["Kota"] .  " - " . $row["Kecamatan"] . " - " . $row["Kelurahan"] . "</option>";
                                                        }
                                                    }
                                                    ?>

                                            </select>
                                        </div>

                                        <div align="right">
                                            <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                                            <br><br><br>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </div>

    <div id="php">
        <?php
            if (isset($_POST['submit'])){
                include 'dist/db.php';

                //class Cart
                class Item{
                    var $id;
                    var $name;
                    var $price;
                    var $discount;
                    var $quantity;
                }


                //Variabel Pendukung
                $idc = $_POST['idc'];
                $ls = "";

                // Konsinasi
                $emp = $_SESSION['username'];
                $cart = unserialize(serialize($_SESSION['cons']));
                $total = 0;
                $discount = 0;
                $SubDasarTotal = 0;
                $tgl = date('Y-m-d H:i:s');
                $eid = $_SESSION['eid'];

                for($i=0; $i<count($cart);$i++) {
                    $discount = $discount + $cart[$i]->discount;
                    $total = $total + ($cart[$i]->price * $cart[$i]->quantity);
                    $SubDasarTotal = $SubDasarTotal + ($cart[$i]->unitprice * $cart[$i]->quantity);
                }
                $subtotal = $total - $discount;
                $ongkir = $_SESSION['ongkir'];
                $grandtotal = $ongkir + $subtotal;
                $add_sales = "INSERT INTO konsinasi (CustomerID, EmployeeID, KonsinasiDate, SubTotal, Discount, Biaya_Pengiriman, SubDasarTotal) VALUES ('$idc', '$eid', '$tgl', '$total' , '$discount' , '$ongkir', '$SubDasarTotal')";

                if (mysqli_query($conn, $add_sales)) {
                    $ls = mysqli_insert_id($conn);
                    echo "Data Penjualan Berhasil Ditambahkan.<br>";
                } else {
                    echo "Error: " . $add_sales . "<br>" . mysqli_error($conn);
                }

                //Konsinasi Detail
                for($i=0; $i<count($cart);$i++) {
                    $pid = $cart[$i]->id;
                    $unitprice = $cart[$i]->unitprice;
                    $price = $cart[$i]->price;
                    $qty = $cart[$i]->quantity;
                    $diskon = $cart[$i]->discount;
                    $qsdetail = "INSERT INTO konsinasi_details (Konsinasi_ID, Product_ID, EmployeeID, Konsinasi_Qty, UnitPrice, Price_sales, Discount) VALUES ('$ls', '$pid', '$eid', '$qty', '$unitprice', '$price', '$diskon')";
                    if (mysqli_query($conn, $qsdetail)) {
                        echo "Detail Penjualan Produk " . $cart[$i]->name . "Berhasil Ditambahkan.<br>";
                    } else {
                        echo "Error: " . $qsdetail . "<br>" . mysqli_error($conn) . "<br><br>";
                    }
                }

                sleep(3);
                unset($_SESSION['cons']);
                unset($_SESSION['ongkir']);
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=cek-consinyasi-sales-form-data.php">';

            }

            ?>
    </div>

    <?php include 'modal.php'; ?>
</body>

</html>
