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
	if ($_POST['save'] == "save") {
		$ProductID           = $_POST['ProductID'];
		$ProductName     	 = $_POST['ProductName'];
		$RemarkProduct       = $_POST['RemarkProduct'];
		$CategoryID          = $_POST['CategoryID'];
		$QuantityPerUnit     = $_POST['QuantityPerUnit'];
		$SalePrice           = $_POST['SalePrice'];
		$UnitPrice           = $_POST['UnitPrice'];
		$Discon              = $_POST['Discon'];
		$UnitsInStock        = $_POST['UnitsInStock'];
		$MinStock            = $_POST['MinStock'];
		$ReorderLevel        = $_POST['ReorderLevel'];
		$tgl_Expired         = $_POST['tgl_Expired'];
		$bln_Expired         = $_POST['bln_Expired'];
		$thn_Expired         = $_POST['thn_Expired'];
		//$Discontinued        = $_POST['Discontinued'];
		//$SatuanTerkecil      = $_POST['SatuanTerkecil'];
		$ekstensi_diperbolehkan	= array('png','jpg');
		$nama                = $_FILES['Gambar']['name'];
		$ukuran	             = $_FILES['Gambar']['size'];
		$file_tmp            = $_FILES['Gambar']['tmp_name'];
		$ExpiredDate         = $thn_Expired."-".$bln_Expired."-".$tgl_Expired;
		echo $ExpiredDate;
		echo $Discontinued;
		echo $SatuanTerkecil;
		
        include "dist/db.php";
		$cekProduk = mysqli_num_rows(mysqli_query($conn, "SELECT ProductID FROM products WHERE ProductID = '$ProductID'"));

		if ($cekProduk > 0) {
            
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
                                    Produk ID tersebut sudah terpakai, silahkan ubah Produk ID anda!
                                </h1>
                              </div>

                              <a href='master-insert-produk.php' class='btn btn-danger btn-user btn-block'>
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
		    
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
            $path = "upload/".$nama;
			
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, $path);
					 $query = mysqli_query($conn, "INSERT INTO products SET ProductID='$ProductID', ProductName='$ProductName', RemarkProduct='$RemarkProduct',  
		                                  CategoryID='$CategoryID', QuantityPerUnit='$QuantityPerUnit', SalePrice='$SalePrice', UnitPrice='$UnitPrice', Discon='$Discon', 
		                                  UnitsInStock='$UnitsInStock', MinStock='$MinStock', ReorderLevel='$ReorderLevel', ExpiredDate='$ExpiredDate', Discontinued='y', 
		                                  SatuanTerkecil='n', Picture='$nama'");

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
                                            Tambah Produk Berhasil ! $nama 
                                        </h1>
                                      </div>
            
                                      <a href='master-produk.php' class='btn btn-success btn-user btn-block'>
                                            Menu Produk
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
            
                                      <a href='master-insert-produk.php' class='btn btn-danger btn-user btn-block'>
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
					
				}else{
					echo 'UKURAN FILE TERLALU BESAR';
				}
			}else{
				echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN ';
			}
    	}
	
	    
	}


?>
    </body>
</html>