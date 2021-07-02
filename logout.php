<?php 

	
// mengaktifkan session
session_start();
include "dist/db.php";
$username		= $_SESSION['username'];
$eid			= $_SESSION['eid'];
$sql = mysqli_query($conn, "UPDATE employees SET login=0 WHERE EmployeeID='$eid' ");
 
// menghapus semua session
session_destroy();
 
// mengalihkan halaman sambil mengirim pesan logout
header("location:index.php");
?>