<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BIO HERBAL-Insert Data Produk</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">
<?php				
	if ($_POST['edit'] == "edit") {
	    //$LastProductID       = $_POST['LastProductID'];
		//$LastEmployeeID    	 = $_POST['LastEmployeeID'];
		$LastUnitsInStock    = $_POST['LastUnitsInStock'];
		$ProductID           = $_POST['ProductID'];
		$EmployeeID     	 = $_POST['EmployeeID'];
		$SalePrice           = $_POST['SalePrice'];
		$UnitPrice           = $_POST['UnitPrice'];
		$Discon              = $_POST['Discon'];
		$UnitsInStock        = $_POST['UnitsInStock'];
		
		include "dist/db.php";
	    $update = mysqli_query($conn, "UPDATE stckproductonemployee SET ProductID='$ProductID', EmployeeID='$EmployeeID', 
	                                  SalePrice='$SalePrice', UnitPrice='$UnitPrice', Discon='$Discon', 
	                                  UnitsInStock='$UnitsInStock' WHERE ProductID='$ProductID' AND EmployeeID='$EmployeeID'");
	    $update = mysqli_query($conn, "UPDATE stckawalproductonemployee SET SalePrice='$SalePrice', UnitPrice='$UnitPrice', Discon='$Discon', 
	                                  UnitsInStock='$UnitsInStock' WHERE ProductID='$ProductID' AND EmployeeID='$EmployeeID'");
	    $query = mysqli_query($conn, "UPDATE products SET UnitsInStock=UnitsInStock-$LastUnitsInStock WHERE ProductID='$LastProductID'");
	    $query = mysqli_query($conn, "UPDATE products SET UnitsInStock=UnitsInStock+$UnitsInStock WHERE ProductID='$ProductID'");
	    
		 if($update){
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
                                    Update Stock Awal Berhasil ! 
                                </h1>
                              </div>
    
                              <a href='master-stock-awal.php' class='btn btn-success btn-user btn-block'>
                                    Menu Stock Awal
                              </a> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>";
    		}
    		else {
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
        
                                  <a href='master-update-stock-awal.php' class='btn btn-danger btn-user btn-block'>
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
</div>
    </div>

</body>
</html>