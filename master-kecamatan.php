<?php
	session_start();
	$thisPage = "master-kecamatan"; 
?>

<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <?php include 'head.php'; ?>

</head>

<body id="page-top">

  <?php include 'session.php'; ?>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include 'topbar.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Master Kecamatan</h1>
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div id="load-history">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Master Kecamatan</h6>
              </div>
              <div class="card-body">
                <a href="master-insert-kecamatan.php" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah Kecamatan</a>
                <br><br>
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>ID</th></th>
                        <th>Kecamatan Name</th>
                        <th>ID Kota</th></th>
                        <th>Kota Name</th>
                        <th>Latitude</th>
                        <th>Longtitude</th>
                        <th>Edit</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>ID</th></th>
                        <th>Kota Name</th>
                        <th>ID Kota</th></th>
                        <th>Kota Name</th>
                        <th>Latitude</th>
                        <th>Longtitude</th>
                        <th>Edit</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php

                      // $dataHistory = mysql_query("SELECT * FROM history ORDER BY id_lampu");
                      $dataKec = mysqli_query($conn, "SELECT KecID, Kecamatan, dk.KotaID, Kota, dkec.Latitude, dkec.Longitude FROM daftarkecamatan dkec join daftarkota dk ON(dkec.KotaID=dk.KotaID) ORDER BY Kecamatan ASC, Kota ASC ");

                      while($Kec = mysqli_fetch_array($dataKec)){
                        $KecID=$Kec['KecID'];
                        $KecName=$Kec['Kecamatan'];  
                        $KotaID=$Kec['KotaID'];
                        $KotaName=$Kec['Kota'];
                        $Latitude = $Kec['Latitude'];
                        $Longitude = $Kec['Longitude'];
                         
                    ?>
                      <tr>
                        <td align="Right"><?php echo $KecID; ?></td>
                        <td><?php echo $KecName; ?></td>
                        <td align="Right"><?php echo $KotaID; ?></td>
                        <td><?php echo $KotaName; ?></td>
                        <td align="Right"><?php echo $Latitude; ?></td>
                        <td align="Right"><?php echo $Longitude; ?></td>
                        <td class="tools" align="center">
                            <a href="master-update-kecamatan.php?KecID=<?php echo $KecID;?>&username=<?php echo $username;?>" title="Klik untuk Update data Kecamatan" class="btn btn-success">
                            <span class="fa fa-edit"></span> Update</a></td>
                      </tr>
                    <?php
                      }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include 'footer.php'; ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php include 'modal3.php'; ?>



</body>

</html>
