<?php
include 'dist/db.php';
$id = $_GET['EmployeeID'];
$sql = "UPDATE employees SET EmployeePassword=md5('Bioherbal@123') WHERE EmployeeID='$id'";
if (mysqli_query($conn, $sql)){
    $_SESSION['pwd'] == $pbaru;
    header("Location:master-pegawai.php");
}
?>