<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BIO HERBAL-Update Delivery</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">
    
<?php
    include 'dist/db.php';
    $id = $_GET['DistribusiID'];
    $status = $_GET['Status'];
    $Data = mysqli_query($conn,"SELECT * FROM distribusi_products WHERE DistribusiID='$id'");
    while($DataProduct = mysqli_fetch_array($Data))
    {
        $From_Emp = $DataProduct['From_Emp'];
        $To_Emp   = $DataProduct['To_Emp'];
        $ProductID= $DataProduct['ProductID'];
        $Qty      = $DataProduct['Qty'];
        $Status      = $DataProduct['Status'];
    }
    if($Status=='OTW'){
        $query = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM stckproductonemployee WHERE ProductID='$ProductID' AND EmployeeID='$To_Emp'"));
    }elseif ($Status=='Ordering'){
        $query = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM stckproductonemployee WHERE ProductID='$ProductID' AND EmployeeID='$From_Emp'"));
    }
    
    
    if ($query > 0){
        
        if ($status=="OTW")
        {	$sql = "UPDATE distribusi_products SET Status='Received', Receive_Date=now() WHERE DistribusiID='$id'";
            if (mysqli_query($conn, $sql)){
                
                $Data = mysqli_query($conn,"SELECT * FROM stckproductonemployee WHERE ProductID='$ProductID' AND EmployeeID='$From_Emp'");
                while($DataProduct = mysqli_fetch_array($Data))
                {
                    $UnitPrice = $DataProduct['UnitPrice'];
                }
                
    			/*$query1="INSERT INTO jurnal (Tanggal_Jurnal,Jenis_Jurnal,No_Bukti,No_Perkiraan,Debet_Jurnal,Kredit_Jurnal, Keterangan_Jurnal,No_Urut) VALUES
                                            (now(),'FD',CONCAT(now(),' - ',$id),CONCAT('1050.',$To_Emp),$UnitPrice*$Qty,0,CONCAT('Distribusi oleh -',$From_Emp,' Ke -',$To_Emp,' Produk -',$ProductID),1),
                                            (now(),'FD',CONCAT(now(),' - ',$id),CONCAT('3001.',$To_Emp),0,$UnitPrice*$Qty,CONCAT('Distribusi oleh -',$From_Emp,' Ke -',$To_Emp,' Produk -',$ProductID),2),
                                            (now(),'FD',CONCAT(now(),' - ',$id),CONCAT('5001.06.',$To_Emp),$UnitPrice*$Qty,0,CONCAT('Distribusi oleh -',$From_Emp,' Ke -',$To_Emp,' Produk -',$ProductID),3),
                                            (now(),'FD',CONCAT(now(),' - ',$id),CONCAT('5001.',$To_Emp),0,$UnitPrice*$Qty,CONCAT('Distribusi oleh -',$From_Emp,' Ke -',$To_Emp,' Produk -',$ProductID),4)";*/
    			$query = mysqli_query($conn, "INSERT INTO jurnal (Tanggal_Jurnal,Jenis_Jurnal,No_Bukti,No_Perkiraan,Debet_Jurnal,Kredit_Jurnal, Keterangan_Jurnal,No_Urut) VALUES
                                            (now(),'FD',$id,CONCAT('1050.',$To_Emp),$UnitPrice*$Qty,0,CONCAT('Distribusi Received From  -',$From_Emp,' To -',$To_Emp,' Product -',$ProductID),1),
                                            (now(),'FD',$id,CONCAT('1401.',$To_Emp),0,$UnitPrice*$Qty,CONCAT('Distribusi Received From -',$From_Emp,' To -',$To_Emp,' Product -',$ProductID),2),
                                            (now(),'FD',$id,CONCAT('5001.06.',$To_Emp),$UnitPrice*$Qty,0,CONCAT('Distribusi Received From -',$From_Emp,' To -',$To_Emp,' Product -',$ProductID),3),
                                            (now(),'FD',$id,CONCAT('5001.',$To_Emp),0,$UnitPrice*$Qty,CONCAT('Distribusi Received From -',$From_Emp,' To -',$To_Emp,' Product -',$ProductID),4)"); 

                $query = mysqli_query($conn, "UPDATE stckproductonemployee SET UnitsInStock=UnitsInStock+$Qty WHERE ProductID='$ProductID' AND EmployeeID='$To_Emp'"); 
                $Data = mysqli_query($conn,"SELECT * FROM stckproductonemployee WHERE ProductID='$ProductID' AND EmployeeID='$To_Emp'");
                echo "
                <div class='row justify-content-center'>
                  <div class='col-xl-5 col-lg-12 col-md-9'>
                    <div class='card o-hidden border-0 shadow-lg my-5'>
                      <div class='card-body p-0'>
                      
                        <!-- Nested Row within Card Body -->
                        <div class='row'>
                          <div class='col-lg-12'>
                            <div class='p-5'>
                              <div class='text-center'>
                                <h1 class='h4 text-gray-900 mb-4'>
                                    Proses penerimaan barang berhasil! 
                                </h1>
                              </div>

                              <a href='distribusi-receive.php' class='btn btn-danger btn-user btn-block'>
                                    Kembali
                              </a> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>";
            }
        }elseif ($status=="Ordering")
        {	$sql = "UPDATE distribusi_products SET Status='Received Order', Receive_Date=now() WHERE DistribusiID='$id'";
            if (mysqli_query($conn, $sql)){
                $query = mysqli_query($conn, "UPDATE stckproductonemployee SET UnitsInStock=UnitsInStock+$Qty WHERE ProductID='$ProductID' AND EmployeeID='$From_Emp'"); 
                $query = mysqli_query($conn, "UPDATE order_details SET Status_Order='Received' WHERE ProductID='$ProductID' AND EmployeeID='$From_Emp' AND Status_Order='Order' AND Quantity='$Qty'"); 
                $Data = mysqli_query($conn,"SELECT * FROM order_details WHERE Status_Order='Received' AND DistribusiID='$id'");
                while($DataProduct = mysqli_fetch_array($Data))
                {
                    $UnitPrice = $DataProduct['OrderPrice'];
                    $OrderID = $DataProduct['OrderID'];
                }
    			/*$test = "INSERT INTO jurnal (Tanggal_Jurnal,Jenis_Jurnal,No_Bukti,No_Perkiraan,Debet_Jurnal,Kredit_Jurnal, Keterangan_Jurnal,No_Urut) VALUES
                                            (now(),'FB','$OrderID',CONCAT('1050.',$To_Emp),$UnitPrice*$Qty,0,CONCAT('Receive From Order to -',$To_Emp,' Product -',$ProductID),1),
                                            (now(),'FB','$OrderID',CONCAT('3001.',$To_Emp),0, $UnitPrice*$Qty,CONCAT('Receive From Order to -',$To_Emp,' Product -',$ProductID),2),
                                            (now(),'FB','$OrderID',CONCAT('5001.',$To_Emp),0, $UnitPrice*$Qty,CONCAT('Receive From Order to -',$To_Emp,' Product -',$ProductID),3),
                                            (now(),'FB','$OrderID',CONCAT('5001.06.',$To_Emp),$UnitPrice*$Qty,0,CONCAT('Receive From Order to -',$To_Emp,' Product -',$ProductID),4)";*/
    			$query = mysqli_query($conn, "INSERT INTO jurnal (Tanggal_Jurnal,Jenis_Jurnal,No_Bukti,No_Perkiraan,Debet_Jurnal,Kredit_Jurnal, Keterangan_Jurnal,No_Urut) VALUES
                                            (now(),'FB','$OrderID',CONCAT('1050.',$From_Emp),$UnitPrice*$Qty,0,CONCAT('Receive From Order to -',$From_Emp,' Product -',$ProductID),1),
                                            (now(),'FB','$OrderID',CONCAT('1401.',$From_Emp),0, $UnitPrice*$Qty,CONCAT('Receive From Order to -',$From_Emp,' Product -',$ProductID),2),
                                            (now(),'FB','$OrderID',CONCAT('5001.',$From_Emp),0, $UnitPrice*$Qty,CONCAT('Receive From Order to -',$From_Emp,' Product -',$ProductID),3),
                                            (now(),'FB','$OrderID',CONCAT('5001.06.',$From_Emp),$UnitPrice*$Qty,0,CONCAT('Receive From Order to -',$From_Emp,' Product -',$ProductID),4)"); 

                echo "
                <div class='row justify-content-center'>
                  <div class='col-xl-5 col-lg-12 col-md-9'>
                    <div class='card o-hidden border-0 shadow-lg my-5'>
                      <div class='card-body p-0'>
                      
                        <!-- Nested Row within Card Body -->
                        <div class='row'>
                          <div class='col-lg-12'>
                            <div class='p-5'>
                              <div class='text-center'>
                                <h1 class='h4 text-gray-900 mb-4'>
                                    Proses penerimaan barang berhasil! 
                                </h1>
                              </div>

                              <a href='distribusi-request.php' class='btn btn-danger btn-user btn-block'>
                                    Kembali
                              </a> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>";
            }
        }
    }else{
        echo "
                <div class='row justify-content-center'>
                  <div class='col-xl-5 col-lg-12 col-md-9'>
                    <div class='card o-hidden border-0 shadow-lg my-5'>
                      <div class='card-body p-0'>
                      
                        <!-- Nested Row within Card Body -->
                        <div class='row'>
                          <div class='col-lg-12'>
                            <div class='p-5'>
                              <div class='text-center'>
                                <h1 class='h4 text-gray-900 mb-4'>
                                    Anda belum mempunyai stok awal, \nsehingga sistem penerimaan belum bisa dilakukan, \nsilahkan input stok awal terlebih dahulu! $sql
                                </h1>
                              </div>
    
                              <a href='distribusi-receive.php' class='btn btn-danger btn-user btn-block'>
                                    Kembali
                              </a> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>";
    }
    
    
    
?>

    </body>
</html>