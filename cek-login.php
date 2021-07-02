<?php
session_start();

include "dist/db.php";

$username			= $_POST['username'];
$password			= $_POST['password'];
$xNotes='';
$sql = mysqli_query($conn, "SELECT * FROM employees WHERE Username='$username' AND EmployeePassword=md5('$password')");	
while($DataPegawai = mysqli_fetch_array($sql)){
    $xNotes= $DataPegawai['Notes'];
}
$cek = mysqli_num_rows($sql);
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $lv = $row['Level'];
        $eid = $row['EmployeeID'];
        $pwd = $row['EmployeePassword'];
        $title =$row['Title'];
    }
}

if(($cek > 0) && ($xNotes == 'Confirm')){
    $sql = mysqli_query($conn, "UPDATE employees SET login=1, LoginDate=NOW() WHERE Username='$username' AND EmployeePassword=md5('$password')");	
    
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    $_SESSION['level'] = $lv;
    $_SESSION['eid'] = $eid;
    $_SESSION['pwd'] = $password;
    $_SESSION['title']=$title;
    header("location:dashboard.php");
    
}   else if ($xNotes == 'Unconfirm'){
        header("location:index.php?pesan=sabar");
}   else{
        header("location:index.php?pesan=gagal");
}

?>
