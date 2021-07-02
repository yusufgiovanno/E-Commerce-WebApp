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

  <title>BIO HERBAL-Insert Orders</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">
    
<?php
	if ($_POST['save'] == "save") {
	    
	    $jumRequest          = $_POST['jumRequest'];
	    $OrderID = $_POST['OrderID'];

		include "dist/db.php";
		
		include "session.php"; 
		    $cekProduk = mysqli_num_rows(mysqli_query($conn, "SELECT OrderID FROM orders WHERE OrderID = '$OrderID'"));
		    if ($cekProduk > 0) {
		        
		    }else
		    {
		        $query = mysqli_query($conn,"INSERT INTO orders (OrderID,EmployeeID,SubTotal,DiskonTransaksi,GrandTotalOrder,Cost_Delivery,Tunai,Status_Order) 
		                                    VALUES('$OrderID', '$eid',0,0,0,0,0,'Order')"); 
		         
		    }
		    $SubTotal=0;
		    $DiskonTransaksi=0;
		    $Total_Cost_Delivery=0;
		    $GrandTotalOrder=0;
		    
		     
			for($i = 1; $i <= $jumRequest; $i++)
            {
               $DistID = $_POST['ID'.$i];
               if (!empty($DistID))
               {
                  $dataDistribusi = mysqli_query($conn, "SELECT dp.ProductID, From_Emp, p.UnitPrice,Qty,Cost_Delivery 
                                                      FROM distribusi_products dp JOIN products p ON(dp.ProductID=p.ProductID) 
                                                      WHERE DistribusiID='$DistID'");

                  while($Distribusi = mysqli_fetch_array($dataDistribusi)){
                    $ProductID = $Distribusi['ProductID'];
                    $From_Emp = $Distribusi['From_Emp'];
                    $UnitPrice = $Distribusi['UnitPrice'];
                    $Qty = $Distribusi['Qty'];
                    $Cost_Delivery = $Distribusi['Cost_Delivery'];
                  }
                  $SubTotal=$SubTotal+($UnitPrice*$Qty);
        		  $DiskonTransaksi=0;
        		  $Total_Cost_Delivery=$Total_Cost_Delivery+$Cost_Delivery;  
        		  $GrandTotalOrder=$GrandTotalOrder+(($UnitPrice*$Qty)-$DiskonTransaksi+$Cost_Delivery);
        		  /*$text="INSERT INTO order_details (OrderID,DistribusiID,ProductID,EmployeeID,OrderPrice,Quantity,Discount,Cost_Delivery,Status_Order) 
                            VALUES('$OrderID', '$DistID','$ProductID','$From_Emp','$UnitPrice','$Qty','0','$Cost_Delivery','Order')";*/
        		  
                  $query = mysqli_query($conn, "INSERT INTO order_details (OrderID,DistribusiID,ProductID,EmployeeID,OrderPrice,Quantity,Discount,Cost_Delivery,Status_Order) 
                            VALUES('$OrderID', '$DistID','$ProductID','$From_Emp','$UnitPrice','$Qty','0','$Cost_Delivery','Order')");
                            
                  $query = mysqli_query($conn, "UPDATE distribusi_products SET Status='Ordering' WHERE DistribusiID='$DistID'");
                  
               }
            }
		    $query = mysqli_query($conn, "UPDATE orders SET SubTotal=SubTotal+$SubTotal, 
		                                                DiskonTransaksi=DiskonTransaksi+$DiskonTransaksi,
		                                                Cost_Delivery=Cost_Delivery+$Total_Cost_Delivery, 
		                                                GrandTotalOrder=GrandTotalOrder+$GrandTotalOrder,
		                                                Tunai=Tunai+$GrandTotalOrder
		                                                WHERE OrderID = '$OrderID'");
		   $query = mysqli_query($conn,"UPDATE jurnal SET Kredit_Jurnal=Kredit_Jurnal+$GrandTotalOrder WHERE Jenis_Jurnal='FB' AND No_Bukti='$OrderID' AND No_Perkiraan=CONCAT('1000.','$eid')");
		   $query = mysqli_query($conn,"UPDATE jurnal SET Debet_Jurnal=Debet_Jurnal+$GrandTotalOrder WHERE Jenis_Jurnal='FB' AND No_Bukti='$OrderID' AND No_Perkiraan=CONCAT('1401.','$eid')");
		   //$query = mysqli_query($conn,"UPDATE orders SET Debet_Jurnal=Debet_Jurnal+$Total_Cost_Delivery WHERE Jenis_Jurnal='FB' AND No_Bukti='$OrderID' AND No_Perkiraan=CONCAT('4001.02.','$eid')");
		   //$query = mysqli_query($conn,"UPDATE orders SET Debet_Jurnal=Debet_Jurnal+$SubTotal WHERE Jenis_Jurnal='FB' AND No_Bukti='$OrderID' AND No_Perkiraan=CONCAT('4001.','$eid')");
		   
		                                   /* ,Jenis_Jurnal,No_Bukti,No_Perkiraan,Debet_Jurnal,Kredit_Jurnal, Keterangan_Jurnal,No_Urut) VALUES
                                            (new.OrderDate,'FB',$OrderID,CONCAT('1000.',new.EmployeeID),0,(new.OrderPrice*new.Quantity)-new.Discount+new.Cost_Delivery,CONCAT('Orders to - ',new.EmployeeID,'-',new.ProductID),1),
                                            (new.OrderDate,'FB',$OrderID,CONCAT('4001.01.',new.EmployeeID),0,new.Discount,CONCAT('Orders to - ',new.EmployeeID,'-',new.ProductID),2),
                                            (new.OrderDate,'FB',$OrderID,CONCAT('4001.02.',new.EmployeeID),new.Cost_Delivery,0,CONCAT('Orders to - ',new.EmployeeID,'-',new.ProductID),3),
                                            (new.OrderDate,'FB',$OrderID,CONCAT('4001.',new.EmployeeID),(new.OrderPrice*new.Quantity),0,CONCAT('Orders to - ',new.EmployeeID,'-',new.ProductID),4)");*/
		    
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
                                    Tambah Orders Product Berhasil !  
                                </h1>
                              </div>
    
                              <a href='distribusi-insert-order.php?OrderID=$OrderID' class='btn btn-success btn-user btn-block'>
                                    Menu Orders
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
                                    Harap periksa kembali dan pastikan data yang Anda masukan lengkap dan benar! 
                                </h1>
                              </div>
    
                              <a href='distribusi-insert-order-request.php?OrderID=$OrderID' class='btn btn-danger btn-user btn-block'>
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