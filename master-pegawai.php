<?php
	session_start();
	$thisPage = "master-pegawai"; 
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
            <h1 class="h3 mb-0 text-gray-800">Master Employees/Pegawai</h1>
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div id="load-history">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Master Employees/Pegawai</h6>
              </div>
              <div class="card-body">
                  <a href="master-insert-pegawai.php" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah Pegawai</a>
                <br><br>
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>ID Pegawai</th>
                        <th>Nama</th>
                        <th>No Handphone</th>
                        <th>Jabatan Pegawai</th>
                        <th>Alamat</th>
                        <!-- <th>Kode Pos</th> -->
                        <th>Atasan</th>
                        <th>Status Register</th>
                        <th>Reset Password</th>
                        <th>Update</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>ID Pegawai</th>
                        <th>Nama</th>
                        <th>No Handphone</th>
                        <th>Jabatan Pegawai</th>
                        <th>Alamat</th>
                        <!-- <th>Kode Pos</th> -->
                        <th>Atasan</th>
                        <th>Status Register</th>
                        <th>Reset Password</th>
                        <th>Update</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php

                      // $dataHistory = mysql_query("SELECT * FROM history ORDER BY id_lampu");
                      $dataPegawai = mysqli_query($conn, "SELECT e1.EmployeeID, e1.PostalCode, e1.TitleOfCourtesy, e1.FirstName, e1.LastName, e1.Phone, e1.Title, e1.Address, e2.TitleOfCourtesy as TOCAtasan, e2.FirstName as FirstAtasan, e2.LastName as  LastAtasan, e1.Notes as XNotes FROM employees e1 LEFT JOIN employees e2 ON(e1.ReportsTo=e2.EmployeeID) WHERE e1.EmployeeID<>'1101'");

                      while($pegawai = mysqli_fetch_array($dataPegawai)){
                        $EmployeeID = $pegawai['EmployeeID'];
                        //$kodepos = $pegawai['PostalCode'];
                        $nama = $pegawai['TitleOfCourtesy']. '. ' .$pegawai['FirstName']. ' ' .$pegawai['LastName'];
                        $telepon = $pegawai['Phone'];
                        $level = $pegawai['Title'];
                        $atasan = $pegawai['TOCAtasan']. '. ' .$pegawai['FirstAtasan']. ' ' .$pegawai['LastAtasan'];
                        $alamat = $pegawai['Address'];
                        $notes = $pegawai['XNotes'];
                         
                    ?>
                      <tr>
                        <td><?php echo $EmployeeID; ?></td>
                        <td><?php echo $nama; ?></td>
                        <td><?php echo $telepon; ?></td>
                        <td><?php echo $level; ?></td>
                        <td><?php echo $alamat; ?></td>
                        <!-- <td><?php echo $kodepos; ?></td> -->
                        <td><?php echo $atasan; ?></td>
                        <td class="tools" align="center">
                            <a onclick='javascript:confirmationUpdate($(this));return false;' href="updateRegister.php?EmployeeID=<?php echo $EmployeeID;?>" title="<?php echo $notes;?>" class="logo-lg">
                            <?php if ($notes=='Confirm'){?> <span class="logo-lg"><img src='img/smile.png' alt='User Activity' width="30px" height="30px"></span> <?php }else{?> <span class="logo-lg"><img src='img/sad_3.png' alt='User Activity' width="30px" height="30px"></span> <?php }; ?>    
                        <span class="fa fa-refresh"></span></a></td>
                        <td class="tools" align="center">
                            <a onclick='javascript:confirmationDelete($(this));return false;' href="resetpassword.php?EmployeeID=<?php echo $EmployeeID;?>" title="Klik untuk reset password <?php echo $nama;?>" class="btn btn-success">
                        <span class="fa fa-refresh"></span> Reset</a></td>
                        <td class="tools" align="center">
                            <a href="master-update-pegawai.php?EmployeeID=<?php echo $EmployeeID;?>&username=<?php echo $username;?>" title="Klik untuk Update data pegawai" class="btn btn-success">
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
  <?php include 'modal4.php'; ?>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Datatables js -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Datatables -->
  <script src="js/demo/datatables-demo.js"></script>
  <script>
        function confirmationDelete(anchor)
        {
           var conf = confirm('Reset Password Menjadi Bioherbal@123 ?');
           if(conf)
              window.location=anchor.attr("href");
        }
        function confirmationUpdate(anchor)
        {
           var conf = confirm('Anda yakin untuk merubah status register user tersebut ?\nProses tersebut akan berpengaruh user tersebut dalam mengakses aplikasi ini');
           if(conf)
              window.location=anchor.attr("href");
        }
  </script>

</body>

</html>
