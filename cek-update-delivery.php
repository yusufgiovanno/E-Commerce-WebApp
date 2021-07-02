<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BIO HERBAL-Insert Data Kota</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">
    
<?php

    if (isset($_GET['DistribusiID'])) {
	    $DistribusiID = $_GET['DistribusiID'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	if ($_POST['edit'] == "edit") {
		//$DistribusiID 	= $_POST['DistribusiID'];
		$Status    	        = $_POST['Status'];

        include "dist/db.php";
		if (($Status=='CancelDelivery') OR ($Status=='ReturnAccepted'))
		{
		    $Data = mysqli_query($conn,"SELECT * FROM distribusi_products WHERE DistribusiID='$DistribusiID'");
            while($DataProduct = mysqli_fetch_array($Data))
            {
                $From_Emp = $DataProduct['From_Emp'];
                $To_Emp   = $DataProduct['To_Emp'];
                $ProductID= $DataProduct['ProductID'];
                $Qty      = $DataProduct['Qty'];
            }
		    $query = mysqli_query($conn, "UPDATE stckproductonemployee SET UnitsInStock=UnitsInStock+$Qty WHERE ProductID='$ProductID' AND EmployeeID='$From_Emp'"); 
            $Data = mysqli_query($conn,"SELECT * FROM stckproductonemployee WHERE ProductID='$ProductID' AND EmployeeID='$From_Emp'");
            while($DataProduct = mysqli_fetch_array($Data))
            {
                $UnitPrice = $DataProduct['UnitPrice'];
            }
			
			$query = mysqli_query($conn, "INSERT INTO jurnal (Tanggal_Jurnal,Jenis_Jurnal,No_Bukti,No_Perkiraan,Debet_Jurnal,Kredit_Jurnal, Keterangan_Jurnal,No_Urut) VALUES
                                        (now(),'FD',$DistribusiID,CONCAT('1050.',$From_Emp),$UnitPrice*$Qty,0,CONCAT('Distribusi ','$Status',' From -',$From_Emp,' To -',$To_Emp,' Product -',$ProductID),1),
                                        (now(),'FD',$DistribusiID,CONCAT('1401.',$From_Emp),0, $UnitPrice*$Qty,CONCAT('Distribusi ','$Status',' From -',$From_Emp,' To -',$To_Emp,' Product -',$ProductID),2),
                                        (now(),'FD',$DistribusiID,CONCAT('5001.06.',$From_Emp),$UnitPrice*$Qty,0,CONCAT('Distribusi ','$Status',' From -',$From_Emp,' To -',$To_Emp,' Product -',$ProductID),3),
                                        (now(),'FD',$DistribusiID,CONCAT('5001.',$From_Emp),0, $UnitPrice*$Qty,CONCAT('Distribusi ','$Status',' From -',$From_Emp,' To -',$To_Emp,' Product -',$ProductID),4)"); 

		
		    $query = mysqli_query($conn, "UPDATE distribusi_products SET Status='$Status',Receive_Date=now() WHERE DistribusiID='$DistribusiID'");
		}else
		{
		    $query = mysqli_query($conn, "UPDATE distribusi_products SET Status='$Status' WHERE DistribusiID='$DistribusiID'");
		}
	   

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
                                Update Success !
                            </h1>
                          </div>

                          <a href='distribusi-delivery.php' class='btn btn-success btn-user btn-block'>
                                Back
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

                          <a href='distribusi-delivery-detail.php' class='btn btn-danger btn-user btn-block'>
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