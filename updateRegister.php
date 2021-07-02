<?php
include 'dist/db.php';
$id = $_GET['EmployeeID'];
$Data = mysqli_query($conn,"SELECT Notes FROM employees WHERE EmployeeID='$id'");
while($DataPegawai = mysqli_fetch_array($Data))
{
    $xNotes= $DataPegawai['Notes'];
}
if ($xNotes=="Confirm")
{	$xNotes = 'Unconfirm';
}else
{	$xNotes='Confirm';
}
$sql = "UPDATE employees SET Notes='$xNotes' WHERE EmployeeID='$id'";
if (mysqli_query($conn, $sql)){
    header("Location:master-pegawai.php");
}
?>