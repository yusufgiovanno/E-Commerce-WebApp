<?php
include 'dist/db.php';
$pid = $_GET['ProductID'];
$eid = $_GET['EmployeeID'];
$Data = mysqli_query($conn,"SELECT Discontinued FROM stckproductonemployee WHERE ProductID='$pid' AND EmployeeID='$eid'");
while($DataProduct = mysqli_fetch_array($Data))
{
    $xDiscontinued= $DataProduct['Discontinued'];
}
if ($xDiscontinued=="n")
{	$xDiscontinued = 'y';
}else
{	$xDiscontinued='n';
}
$sql = "UPDATE stckproductonemployee SET Discontinued='$xDiscontinued' WHERE ProductID='$pid' AND EmployeeID='$eid'";
if (mysqli_query($conn, $sql)){
    header("Location:master-stock-awal.php");
}
?>