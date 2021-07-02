<?php
session_start();
include 'dist/db.php';

//class Cart
class Item{
    var $id;
    var $name;
    var $price;
    var $unitprice;
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
$total=0;
$discount = 0;
$subtotal = 0;
$SubDasarTotal = 0;
$tgl = date('Y-m-d H:i:s');
$eid = $_SESSION['eid'];

for($i=0; $i<count($cart);$i++) {
    $discount = $discount + $cart[$i]->discount;
    $total = $total + ($cart[$i]->price * $cart[$i]->quantity);
    $SubDasarTotal = $SubDasarTotal + ($cart[$i]->unitprice * $cart[$i]->quantity);
}

echo $SubDasarTotal = $SubDasarTotal + ($cart[$i]->unitprice * $cart[$i]->quantity);

$subtotal = $total - $discount;
$ongkir = $_SESSION['ongkir'];
$grandtotal = $ongkir + $subtotal;
$add_sales = "INSERT INTO sales (SalesID, CustomerID, EmployeeID, SaleDate, SubTotal, DiskonTransaksi, GrandTotalSale, Tunai, Biaya_Pengiriman, SubDasarTotal) VALUES ('$tgl', '$idc', '$eid', '$tgl', '$subtotal' , '$discount' , '$grandtotal' , '$grandtotal', '$ongkir', '$SubDasarTotal')";

if (mysqli_query($conn, $add_sales)) {
    $ls = mysqli_insert_id($conn);
    echo "Data Penjualan Berhasil Ditambahkan.<br>";
} else {
    echo "Error: " . $add_sales . "<br>" . mysqli_error($conn);
}

//Sales Detail
for($i=0; $i<count($cart);$i++) {
    $pid = $cart[$i]->id;
    $price = $cart[$i]->price;
    $qty = $cart[$i]->quantity;
    $discount = $cart[$i]->discount;
    $qsdetail = "INSERT INTO sales_details (SalesID, ProductID, UnitPrice, OrderPrice, Quantity, Discount) VALUES ('$tgl', '$pid', '$price', '$total', '$qty', '$discount')";
    if (mysqli_query($conn, $qsdetail)) {
        echo "Detail Penjualan Produk " . $cart[$i]->name . "Berhasil Ditambahkan.<br>";
    } else {
        echo "Error: " . $qsdetail . "<br>" . mysqli_error($conn) . "<br><br>";
    }
}

sleep(3);
unset($_SESSION['ongkir']);
unset($_SESSION['cart']);
header('Location:dashboard.php');
?>
