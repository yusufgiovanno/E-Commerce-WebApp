<?php
include 'dist/db.php';
$id = $_GET['ProductID'];
$Data = mysqli_query($conn,"SELECT Discontinued FROM products WHERE ProductID='$id'");
while($DataProduct = mysqli_fetch_array($Data))
{
    $xDiscontinued= $DataProduct['Discontinued'];
}
if ($xDiscontinued=="n")
{	$xDiscontinued = 'y';
}else
{	$xDiscontinued='n';
}
$sql = "UPDATE products SET Discontinued='$xDiscontinued' WHERE ProductID='$id'";
if (mysqli_query($conn, $sql)){
    header("Location:master-produk.php");
}
?>