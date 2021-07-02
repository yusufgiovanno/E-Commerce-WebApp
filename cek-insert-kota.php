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
	if ($_POST['save'] == "save") {
		$Kota 		    	= $_POST['Kota'];
		$PropinsiID    	    = $_POST['PropinsiID'];
		$Latitude           = $_POST['Latitude'];
		$Longitude          = $_POST['Longitude'];

        include "dist/db.php";
		$cekPropinsi = mysqli_num_rows(mysqli_query($conn, "SELECT Kota FROM daftarkota WHERE Kota = '$Kota' AND PropinsiID='$PropinsiID' "));

		if ($cekPropinsi > 0) {
            
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
                                    Nama Kota tersebut sudah terpakai dalam Propinsi yang sama, silahkan ubah nama Kota atau Propinsi!
                                </h1>
                              </div>

                              <a href='master-insert-kota.php' class='btn btn-danger btn-user btn-block'>
                                    Kembali
                              </a> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>";
                
		} else {
		    
		    $query = mysqli_query($conn, "INSERT INTO daftarkota SET Kota='$Kota',PropinsiID='$PropinsiID ', Latitude='$Latitude', Longitude='$Longitude'");

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
                                    Tambah Kota Berhasil !
                                </h1>
                              </div>
    
                              <a href='master-kota.php' class='btn btn-success btn-user btn-block'>
                                    Kembali
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
    
                              <a href='master-insert-kota.php' class='btn btn-danger btn-user btn-block'>
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
	
	    
	}


?>
    </body>
</html>