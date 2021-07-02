<?php
	session_start();
	$thisPage = "cash-in"; 
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
            <h1 class="h3 mb-0 text-gray-800">CASH IN</h1>
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div id="load-history">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Cash In</h6>
              </div>
              <div class="card-body">
                <a href="cash-in-insert.php" class="btn btn-primary"><span class="fa fa-plus"></span> Add Cash In</a>
                <br><br>
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>ID</th></th>
                        <th>Date</th>
                        <th>subject</th>
                        <th>Niminal</th></th>
                        <th>Keterangan</th>
                        <th>Bukti</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>ID</th></th>
                        <th>Date</th>
                        <th>subject</th>
                        <th>Niminal</th></th>
                        <th>Keterangan</th>
                        <th>Bukti</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php

                      // $dataHistory = mysql_query("SELECT * FROM history ORDER BY id_lampu");
                      $dataCashFlow = mysqli_query($conn, "SELECT * FROM cash_flow WHERE EmployeeID='$eid' AND Cash_Type='in'");

                      while($Cash_Flow = mysqli_fetch_array($dataCashFlow)){
                        $ID_Cash=$Cash_Flow['ID_Cash'];
                        $Cash_Date=$Cash_Flow['Cash_Date'];
                        $Nominal = $Cash_Flow['Nominal'];
                        $Keterangan = $Cash_Flow['Keterangan'];
                        $Bukti = $Cash_Flow['Bukti'];
                        $subject = $Cash_Flow['subject'];
                         
                    ?>
                      <tr>
                        <td align="Right"><?php echo $ID_Cash; ?></td>
                        <td><?php echo $Cash_Date; ?></td>
                        <td><?php echo $subject; ?></td>
                        <td align="Right"><?php echo number_format($Nominal); ?></td>
                        <td><?php echo $Keterangan; ?></td>
                        <td><?php echo $Bukti; ?></td>
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
