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

  <title>BIO HERBAL-Insert Setoran</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">
    
<?php
	if ($_POST['save'] == "save") {
		$Atasan		= $_POST['atasanID'];
		$Nominal	= $_POST['Nominal'];
		$NominalDasarIncome	= $_POST['NominalDasarIncome'];
		$Periodex	= $_POST['Periode'];
		$Periode	= $Periodex .'-01 00:00:00';

        include "dist/db.php";
        include "session.php"; 
        $ID_Setor=0;
        $Data = mysqli_query($conn,"SELECT * FROM setoran ORDER BY ID_Setor DESC LIMIT 1");
            while($DataProduct = mysqli_fetch_array($Data))
            {
                $ID_Setor = $DataProduct['ID_Setor'];
            }
        $ID_Setor=$ID_Setor+1;
        
        $Data = mysqli_query($conn,"select date_add('$Periode', INTERVAL 1 month) as nextPeriode");
            while($DataProduct = mysqli_fetch_array($Data))
            {
                $nextPeriode = $DataProduct['nextPeriode'];
            }
        $query = mysqli_query($conn, "INSERT INTO jurnal (Tanggal_Jurnal,Jenis_Jurnal,No_Bukti,No_Perkiraan,Debet_Jurnal,Kredit_Jurnal, Keterangan_Jurnal,No_Urut) VALUES
                                            ('$nextPeriode','BU',$ID_Setor,CONCAT('1000.',$eid),0,$Nominal,CONCAT('Setoran Pendapatan dari -',$eid,' ke -',$Atasan),1),
                                            ('$nextPeriode','BU',$ID_Setor,CONCAT('4001.',$eid), $Nominal,0,CONCAT('Setoran Pendapatan dari -',$eid,' ke -',$Atasan),2),
                                            ('$nextPeriode','BU',$ID_Setor,CONCAT('5001.06.',$eid), 0,$NominalDasarIncome,CONCAT('Setoran Pendapatan dari -',$eid,' ke -',$Atasan),3),
                                            ('$nextPeriode','BU',$ID_Setor,CONCAT('1401.',$eid), $NominalDasarIncome,0,CONCAT('Setoran Pendapatan dari -',$eid,' ke -',$Atasan),4),
                                            ('$nextPeriode','BU',$ID_Setor,CONCAT('1000.',$Atasan), $Nominal,0,CONCAT('Setoran Pendapatan dari -',$eid,' ke -',$Atasan),5),
                                            ('$nextPeriode','BU',$ID_Setor,CONCAT('4001.',$Atasan), 0,$Nominal,CONCAT('Setoran Pendapatan dari -',$eid,' ke -',$Atasan),6),
                                            ('$nextPeriode','BU',$ID_Setor,CONCAT('5001.06.',$Atasan), $NominalDasarIncome,0,CONCAT('Setoran Pendapatan dari -',$eid,' ke -',$Atasan),7),
                                            ('$nextPeriode','BU',$ID_Setor,CONCAT('1401.',$Atasan), 0,$NominalDasarIncome,CONCAT('Setoran Pendapatan dari -',$eid,' ke -',$Atasan),8)");  
        
		$query = mysqli_query($conn, "INSERT INTO setoran (Periode, FromEmployeeID, ToEmployeeID, Nominal) VALUES ('$Periodex','$eid', '$Atasan', '$Nominal') ");

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
                                Insert Setoran Success !$Periode
                            </h1>
                          </div>

                          <a href='transaction-setoran.php' class='btn btn-success btn-user btn-block'>
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

                          <a href='transaction-setoran-insert.php' class='btn btn-danger btn-user btn-block'>
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