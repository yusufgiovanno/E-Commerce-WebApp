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
                                    <a class="btn btn-success" href="transaction-sales-form-data-new.php" style="margin-right:auto; margin-left:auto; display:block;">Registrasi Customer Baru</a>
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

                                        <label>Sakit Yang Dialami</label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="Asma" name="s0">Asma
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="Maag" name="s1">Maag
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="Diabetes" name="s2">Diabetes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="Asam Urat" name="s3">Asam Urat
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="Hipertensi" name="s4">Hipertensi
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="Migrain" name="s5">Migrain
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="Stroke" name="s6">Stroke
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="lemah jantung" name="s7">Lemah Jantung
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="stamina" name="s8">Stamina
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput2">Lain-lain</label>
                                            <input type="text" name="s9" class="form-control" placeholder="Isi data penyakit lain jika ada">
                                        </div>
                                        <br>
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

                //print_r($_POST);

                //Variabel Pendukung
                $idc = $_POST['idc'];
                $ls = "";

                //Insert Sakit
                $sakit = array($_POST['s0'], $_POST['s1'], $_POST['s2'], $_POST['s3'], $_POST['s4'], $_POST['s5'], $_POST['s6'], $_POST['s7'], $_POST['s8'], $_POST['s9']);

                for($i = 0; $i<10; $i++){
                    if ($sakit[$i] != ""){
                        $sql = "INSERT INTO detailsakit (CustomerID, Sakit) VALUES ('$idc', '$sakit[$i]')";
                        if (mysqli_query($conn, $sql)) {
                            echo "Data Sakit $sakit[$i] Berhasil Ditambahkan <br>";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    }
                }

                // Sales
                $emp = $_SESSION['username'];
                $cart = unserialize(serialize($_SESSION['cart']));
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
                $add_sales = "INSERT INTO sales (SalesID, CustomerID, EmployeeID, SaleDate, SubTotal, DiskonTransaksi, GrandTotalSale, Tunai, Biaya_Pengiriman, SubDasarTotal) VALUES ('$tgl', '$idc', '$eid', '$tgl', '$total' , '$discount' , '$grandtotal' , '$grandtotal', '$ongkir', '$SubDasarTotal')";

                if (mysqli_query($conn, $add_sales)) {
                    $ls = mysqli_insert_id($conn);
                    echo "Data Penjualan Berhasil Ditambahkan.<br>";
                } else {
                    echo "Error: " . $add_sales . "<br>" . mysqli_error($conn);
                }

                //Sales Detail
                for($i=0; $i<count($cart);$i++) {
                    $pid = $cart[$i]->id;
                    $unitprice = $cart[$i]->unitprice;
                    $price = $cart[$i]->price;
                    $qty = $cart[$i]->quantity;
                    $diskon = $cart[$i]->discount;
                    $qsdetail = "INSERT INTO sales_details (SalesID, ProductID, UnitPrice, OrderPrice, Quantity, Discount, EmployeeID) VALUES ('$tgl', '$pid', '$unitprice', '$price', '$qty', '$diskon','$eid')";
                    if (mysqli_query($conn, $qsdetail)) {
                        echo "Detail Penjualan Produk " . $cart[$i]->name . "Berhasil Ditambahkan.<br>";
                    } else {
                        echo "Error: " . $qsdetail . "<br>" . mysqli_error($conn) . "<br><br>";
                    }
                }

                sleep(3);
                unset($_SESSION['cart']);
                unset($_SESSION['ongkir']);
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=cek-transaction-sales-form-data.php">';

            }

            ?>
    </div>

    <?php include 'modal.php'; ?>
</body>

</html>
