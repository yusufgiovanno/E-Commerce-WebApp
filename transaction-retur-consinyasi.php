<?php
	session_start();
	$thisPage = "Transaction-Retur-Consinyasi"; 
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
            <h1 class="h3 mb-0 text-gray-800">Retur Consignment</h1>
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div id="load-history">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Retur Consignment</h6>
              </div>
              <div class="card-body">
                <!--<a href="master-insert-stock-awal.php" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah Produk</a>-->
                <br>
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                              <tr>
                                <th>Tanggal</th>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Sub Total</th>
                                <th>Discount</th>
                                <th>Cost Delivery</th>
                                <th>Nominal Return</th>
                                <th>Return Date</th>
                                <th>Detail</th>
                              </tr>
                            </thead>
                            <tfoot>
                              <tr>
                                <th>Tanggal</th>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Sub Total</th>
                                <th>Discount</th>
                                <th>Cost Delivery</th>
                                <th>Nominal Return</th>
                                <th>Return Date</th>
                                <th>Detail</th>
                              </tr>
                            </tfoot>
                            <tbody>
                    
                    <?php
                            $eid = $_SESSION['eid'];
                            $dataKons = mysqli_query($conn, "SELECT Konsinasi_ID, k.CustomerID, Name, Kelurahan, Kecamatan, Kota, KonsinasiDate, SubTotal, Discount, Biaya_Pengiriman, NominalReturn, ReturnDate 
                                                            FROM konsinasi k JOIN customers c ON(k.CustomerID=c.CustomerID) 
                                                            JOIN daftar_kelurahan dk ON (c.KelID=dk.KelID)
                                                            JOIN daftarkecamatan dkec ON (dk.KecID=dkec.KecID)
                                                            JOIN daftarkota dkot ON (dkec.KotaID=dkot.KotaID)
                                                            WHERE EmployeeID='$eid' ORDER BY KonsinasiDate ASC ");    
                       
                          while($Kons = mysqli_fetch_array($dataKons)){
                            $KonsID = $Kons['Konsinasi_ID'];
                            $Cust = $Kons['CustomerID'];
                            $CustName = $Kons['Name'];
                            $CustKel = $Kons['Kelurahan'];
                            $CustKec = $Kons['Kecamatan'];
                            $CustKota = $Kons['Kota'];
                            $tgl = $Kons['KonsinasiDate'];
                            $SubTotal = $Kons['SubTotal'];
                            $Discount = $Kons['Discount'];
                            $Biaya_Pengiriman = $Kons['Biaya_Pengiriman'];
                            $NominalReturn = $Kons['NominalReturn'];
                            $ReturnDate = $Kons['ReturnDate'];
                        ?>
                          <tr>
                            <td><?php echo $tgl; ?></td>
                            <td><?php echo $KonsID; ?></td>
                            <td><?php echo $Cust . ' - ' . $CustName . ' - ' . $CustKel . ' - ' . $CustKec . ' - '. $CustKota; ?></td>
                            <td align="right"><?php echo number_format($SubTotal); ?></td>
                            <td align="right"><?php echo number_format($Discount); ?></td>
                            <td align="right"><?php echo number_format($Biaya_Pengiriman); ?></td>
                            <td align="right"><?php echo number_format($NominalReturn); ?></td>
                            <td><?php echo $ReturnDate; ?></td>
                            <td>
                                <?php if ($NominalReturn==0){?>
                                <a href="transaction-retur-consinyasi-detail.php?ID=<?php echo $KonsID;?>" title="Klik untuk detail data konsinyasi" class="btn btn-success">
                                <span class="fa fa-edit"></span>Details</a><?php }?></td>
                          </tr>
                            <?php } ?>
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
</body>

</html>