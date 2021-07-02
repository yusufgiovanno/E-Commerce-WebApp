<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BIO HERBAL-Insert Data Pegawai</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">
    
<?php
	if ($_POST['save'] == "save") {
		$EmployeeID         = $_POST['EmployeeID'];
		$FirstName     	    = $_POST['FirstName'];
		$LastName           = $_POST['LastName'];
		$Title              = $_POST['Title'];
		$Level              = $_POST['Level'];
		$TitleOfCourtesy    = $_POST['TitleOfCourtesy'];
		$tgl_lahir          = $_POST['tgl_lahir'];
		$bln_lahir          = $_POST['bln_lahir'];
		$thn_lahir          = $_POST['thn_lahir'];
		$tgl_bekerja        = $_POST['tgl_bekerja'];
		$bln_bekerja        = $_POST['bln_bekerja'];
		$thn_bekerja        = $_POST['thn_bekerja'];
		$Address            = $_POST['Address'];
		$Phone              = $_POST['Phone'];
		$City               = $_POST['City'];
		$Region             = $_POST['Region'];
		$PostalCode         = $_POST['PostalCode'];
		$Country            = $_POST['Country'];
		$Nationality        = $_POST['Nationality'];
		$Username           = $_POST['Username'];
		$EmployeePassword   = $_POST['EmployeePassword'];
		$ReportsTo          = $_POST['ReportsTo'];
		
		$BirthDate          = $thn_lahir."-".$bln_lahir."-".$tgl_lahir;
		$HireDate           = $thn_bekerja."-".$bln_bekerja."-".$tgl_bekerja;
		
				
// 		echo $EmployeeID . "<br>";
// 		echo $FirstName . "<br>";
// 		echo $LastName . "<br>";
// 		echo $Title . "<br>";
// 		echo $Level . "<br>";
// 		echo $TitleOfCourtesy . "<br>";
// 		echo $BirthDate . "<br>";
// 		echo $HireDate . "<br>";
// 		echo $Address . "<br>";
// 		echo $Phone . "<br>";
// 		echo $City . "<br>";
// 		echo $Region . "<br>";
// 		echo $PostalCode . "<br>";
// 		echo $Country . "<br>";
// 		echo $Nationality . "<br>";
// 		echo $Username . "<br>";
// 		echo $EmployeePassword . "<br>";
// 		echo $ReportsTo . "<br>";
        if (($ReportsTo == 'Pilih Atasan') && ($Level==1)){
            $ReportsTo=$EmployeeID;
        }
        
		
        include "dist/db.php";
		$cekUser = mysqli_num_rows(mysqli_query($conn, "SELECT Username FROM employees WHERE Username = '$Username'"));

		if ($cekUser > 0) {
            
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
                                    Username tersebut sudah terpakai, silahkan ubah username anda!
                                </h1>
                              </div>

                              <a href='master-insert-pegawai.php' class='btn btn-danger btn-user btn-block'>
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
		    $query = mysqli_query($conn, "INSERT INTO employees SET EmployeeID='$EmployeeID', FirstName='$FirstName', LastName='$LastName', Title='$Title', 
		                                  Level='$Level', TitleOfCourtesy='$TitleOfCourtesy', BirthDate='$BirthDate', HireDate='$HireDate', Address='$Address', 
		                                  Phone='$Phone', City='$City', Region='$Region', PostalCode='$PostalCode', Country='$Country', Nationality='$Nationality', 
		                                  Username='$Username', EmployeePassword=md5('$EmployeePassword'), ReportsTo='$ReportsTo', Notes='Unconfirm'");

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
                                    Tambah Pegawai Berhasil !
                                </h1>
                              </div>
    
                              <a href='master-pegawai.php' class='btn btn-success btn-user btn-block'>
                                    Menu Pegawai
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
                                    Harap periksa kembali dan pastikan data yang Anda masukan lengkap dan benar !
                                </h1>
                              </div>
    
                              <a href='master-insert-pegawai.php' class='btn btn-danger btn-user btn-block'>
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