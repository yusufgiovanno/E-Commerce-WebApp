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

  <title>BIO HERBAL-Insert Data Stok Awal</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">
    
<?php
	if ($_POST['save'] == "save") {
		$ProductID           = $_POST['ProductID'];
		$EmployeeID     	 = $_POST['EmployeeID'];
		$Qty                 = $_POST['Qty'];
		$CostDelivery        = $_POST['CostDelivery'];
		
		include "dist/db.php";
		
		include "session.php"; 
		    
			
		    $query = mysqli_query($conn, "INSERT INTO distribusi_products (Dist_Date, ProductID, Qty,Cost_Delivery, From_Emp, To_Emp, Status)
			                             VALUES(now(),'$ProductID', $Qty,$CostDelivery,'$eid','$EmployeeID','Request')");
			//$query = mysqli_query($conn, "UPDATE stckproductonemployee SET UnitsInStock=UnitsInStock-$Qty WHERE ProductID='$ProductID' AND EmployeeID='$eid'"); 
			
			/*$Data = mysqli_query($conn,"SELECT * FROM stckproductonemployee WHERE ProductID='$ProductID' AND EmployeeID='$eid'");
            while($DataProduct = mysqli_fetch_array($Data))
            {
                $UnitPrice = $DataProduct['UnitPrice'];
            }
            $Data = mysqli_query($conn,"SELECT * FROM distribusi_products ORDER BY DistribusiID DESC LIMIT 1");
            while($DataProduct = mysqli_fetch_array($Data))
            {
                $DistribusiID = $DataProduct['DistribusiID']+1;
            }
			
			$query = mysqli_query($conn, "INSERT INTO jurnal (Tanggal_Jurnal,Jenis_Jurnal,No_Bukti,No_Perkiraan,Debet_Jurnal,Kredit_Jurnal, Keterangan_Jurnal,No_Urut) VALUES
                                            (now(),'FJ',CONCAT(now(),' - ',$DistribusiID),CONCAT('1050.',$eid),0,$UnitPrice*$Qty,CONCAT('Distribusi oleh -',$eid,' Ke -',$EmployeeID,' Produk -',$ProductID),1),
                                            (now(),'FJ',CONCAT(now(),' - ',$DistribusiID),CONCAT('5001.',$eid), $UnitPrice*$Qty,0,CONCAT('Distribusi oleh -',$eid,' Ke -',$EmployeeID,' Produk -',$ProductID),2)"); 
            */
			if ($query) {
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
                                    Tambah Delivery Product Berhasil !  
                                </h1>
                              </div>
    
                              <a href='distribusi-request.php' class='btn btn-success btn-user btn-block'>
                                    Menu Request Product to Order
                              </a> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>";
    
    		} else {
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
                                    Harap periksa kembali dan pastikan data yang Anda masukan lengkap dan benar! $eid
                                </h1>
                              </div>
    
                              <a href='distribusi-insert-request.php' class='btn btn-danger btn-user btn-block'>
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


?>
    </body>
</html>