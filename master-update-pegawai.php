<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <?php include 'head2.php'; ?>
  
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  
  <style>
      .select2-container {
        width: 100% !important;
      }
  </style>

</head>

<body id="page-top">

  <?php
    $thisPage = "master-pegawai"; 
    include 'session2.php';
    $EmployeeID = $_GET['EmployeeID'];
    $queryPegawai = mysqli_query($conn, "SELECT * FROM employees WHERE EmployeeID='$EmployeeID'") or die(mysql_error());

	while($updatePegawai = mysqli_fetch_array($queryPegawai)){
    ?>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include 'sidebar2.php'; ?>
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
            <h1 class="h3 mb-0 text-gray-800">Update Employees</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
              
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Update Employees</h6>
            </div>
            
            <div class="container">
              <form action="cek-update-pegawai.php?EmployeeID=<?php echo $EmployeeID;?>" method="POST">
                  
              <!-- ID -->
              <div class="row">
                <div class="col-25">
                  <label>No. ID Pegawai </label>
                </div>
                <div class="col-75">
                  <input type="text" name="EmployeeID" placeholder="Masukkan ID Pegawai" class="form-control" value="<?php echo $updatePegawai['EmployeeID'];?>" readonly="">
                </div>
              </div>    
                
              <!-- Nama Depan -->
              <div class="row">
                <div class="col-25">
                  <label>Nama Depan </label>
                </div>
                <div class="col-75">
                  <input type="text" name="FirstName" placeholder="Masukkan Nama Depan Pegawai" class="form-control" value="<?php echo $updatePegawai['FirstName'];?>">
                </div>
              </div>

              <!-- NAMA PEGAWAI -->
              <div class="row">
                <div class="col-25">
                  <label>Nama Belakang </label>
                </div>
                <div class="col-75">
                  <input type="text" name="LastName" placeholder="Masukkan Nama Belakang Pegawai" class="form-control" value="<?php echo $updatePegawai['LastName'];?>">
                </div>
              </div>

              <!-- TITLE -->
              <div class="row">
                <div class="col-25">
                  <label>Jabatan </label>
                </div>
                <div class="col-75">
                  <select id="Title" name="Title" class="form-control">
                    <option value="">Pilih Jabatan Pegawai</option>
                    <option value="Admin" <?php echo ($updatePegawai['Title']=='Admin')?"selected":"";?>>Admin</option>
                    <option value="Direktur" <?php echo ($updatePegawai['Title']=='Direktur')?"selected":"";?>>Direktur</option>
                    <option value="Area Manager" <?php echo ($updatePegawai['Title']=='Area Manager')?"selected":"";?>>Area Manager</option>
                    <option value="Mitra Kerja" <?php echo ($updatePegawai['Title']=='Mitra Kerja')?"selected":"";?>>Mitra Kerja</option>
                  </select>
                </div>
              </div>
              
              <!-- Level -->
              <div class="row">
                <div class="col-25">
                  <label>Level Jabatan </label>
                </div>
                <div class="col-75">
                  <select id="Level" name="Level" class="form-control">
                    <option value="">Pilih Tingkatan Jabatan (Sesuaikan Dengan Status)</option>
                    <option value="1" <?php echo ($updatePegawai['Level']=='1')?"selected":"";?>>1 = Admin</option>
                    <option value="2" <?php echo ($updatePegawai['Level']=='2')?"selected":"";?>>2 = Direktur</option>
                    <option value="3" <?php echo ($updatePegawai['Level']=='3')?"selected":"";?>>3 = Area Manager</option>
                    <option value="4" <?php echo ($updatePegawai['Level']=='4')?"selected":"";?>>4 = Mitra Kerja</option>
                  </select>
                </div>
              </div>
              
               <!-- GENDER -->
              <div class="row">
                <div class="col-25">
                  <label>Title of Courtesy </label>
                </div>
                <div class="col-75">
                  <select id="TitleOfCourtesy" name="TitleOfCourtesy" class="form-control">
                    <option value="">Pilih Tingkatan Pegawai (Sesuaikan Dengan Status)</option>
                    <!--<option value=""><?php echo $updatePegawai['TitleOfCourtesy'];?></option>-->
                    <option value="Mr" <?php echo ($updatePegawai['TitleOfCourtesy']=='Mr')?"selected":"";?>>Mr</option>
                    <option value="Mrs" <?php echo ($updatePegawai['TitleOfCourtesy']=='Mrs')?"selected":"";?>>Mrs</option>
                    <option value="Miss" <?php echo ($updatePegawai['TitleOfCourtesy']=='Miss')?"selected":"";?>>Miss</option>
                  </select>
                </div>
              </div>
              
              <!-- TANGGAL LAHIR -->
              <div class="row">
                <div class="col-25">
                  <label>Tanggal Lahir</label>
                </div>
                
                <?php 
                    // Untuk ambil tanggal
                    $birth = $updatePegawai['BirthDate']; 
                    $tanggal = date('d', strtotime($birth));
                ?>
                <div class="col-15">
                    <select name="tgl_lahir" size="1" id="tgl" class="form-control">
                          <?
            		        for ($i=1;$i<=31;$i++) {
            			        echo '<option value="'. $i .'"'. ($tanggal == $i ? ' selected="selected"' : '') .'>'. $i .'</option>';
            			    }
                		  ?>
                     </select>
                </div>
                
                <?php 
                    // Untuk ambil bulan
                    $month = date('m', strtotime($birth));
                ?>
                <div class="col-15">
                    <select name="bln_lahir" size="1" id="bln" class="form-control">
                          <?
                		     $bulan=array("","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                		     for ($i=1;$i<=12;$i++)
                			 {
                			   echo '<option value="'. $i .'"'. ($month == $i ? ' selected="selected"' : '') .'>'. $bulan[$i] .'</option>';
                			 }
                		  ?>
                	</select>
                </div>
                
                <?php 
                    // Untuk ambil tahun
                    $tahun = date('Y', strtotime($birth));
                ?>
                <div class="col-15">
                    <select name="thn_lahir" size="1" id="thn" class="form-control">
                          <?
                		     for ($i=1980;$i<=2100;$i++)
                			 {
                			   echo '<option value="'. $i .'"'. ($tahun == $i ? ' selected="selected"' : '') .'>'. $i .'</option>';
                			 }
                		  ?>
                     </select>
                </div>       
                        
              </div>
              
              <!-- TANGGAL KERJA -->
              <div class="row">
                <div class="col-25">
                  <label>Tanggal Bekerja</label>
                </div>
                
                <?php 
                    // Untuk ambil tanggal
                    $hire = $updatePegawai['HireDate']; 
                    $tanggalHire = date('d', strtotime($hire));
                ?>
                <div class="col-15">
                    <select name="tgl_bekerja" size="1" id="tgl2" class="form-control">
                          <?
                		     for ($i=1;$i<=31;$i++)
                			 {
                			   echo '<option value="'. $i .'"'. ($tanggalHire == $i ? ' selected="selected"' : '') .'>'. $i .'</option>';
                			 }
                		  ?>
                     </select>
                </div>
                
                <?php 
                    // Untuk ambil bulan
                    $monthHire = date('m', strtotime($hire));
                ?>
                <div class="col-15">
                    <select name="bln_bekerja" size="1" id="bln2" class="form-control">
                          <?
                		     $bulan=array("","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                		     for ($i=1;$i<=12;$i++)
                			 {
                			   echo '<option value="'. $i .'"'. ($monthHire == $i ? ' selected="selected"' : '') .'>'. $bulan[$i] .'</option>';
                			 }
                		  ?>
                	</select>
                </div>
                
                <?php 
                    // Untuk ambil tahun
                    $tahunHire = date('Y', strtotime($hire));
                ?>
                <div class="col-15">
                    <select name="thn_bekerja" size="1" id="thn2" class="form-control">
                          <?
                		     for ($i=2000;$i<=2100;$i++)
                			 {
                			   echo '<option value="'. $i .'"'. ($tahunHire == $i ? ' selected="selected"' : '') .'>'. $i .'</option>';
                			 }
                		  ?>
                     </select>
                </div>       
              </div>
              
              <!-- ALAMAT PEGAWAI -->
              <div class="row">
                <div class="col-25">
                  <label>Alamat Pegawai </label>
                </div>
                <div class="col-75">
                  <input type="text" name="Address" placeholder="Masukkan Alamat Lengkap Pegawai" class="form-control" value="<?php echo $updatePegawai['Address'];?>">
                </div>
              </div>
              
              <!-- HANDPHONE -->
              <div class="row">
                <div class="col-25">
                  <label>No. Handphone </label>
                </div>
                <div class="col-75">
                  <input type="text" name="Phone" placeholder="Masukkan Nomor Handphone Pegawai" class="form-control" value="<?php echo $updatePegawai['Phone'];?>">
                </div>
              </div>
              
              <!-- KOTA ASAL -->
              <div class="row">
                <div class="col-25">
                  <label>Kota/Kabupaten</label>
                </div>
                <div class="col-75">
                  <input type="text" name="City" placeholder="Masukkan Kota/Kabupaten" class="form-control" value="<?php echo $updatePegawai['City'];?>">
                </div>
              </div>
              
              <!-- PROPINSI ASAL -->
              <div class="row">
                <div class="col-25">
                  <label>Propinsi</label>
                </div>
                <div class="col-75">
                  <input type="text" name="Region" placeholder="Masukkan Propinsi" class="form-control" value="<?php echo $updatePegawai['Region'];?>">
                </div>
              </div>
              
              <!-- KODE POS -->
              <div class="row">
                <div class="col-25">
                  <label>Kode Pos</label>
                </div>
                <div class="col-75">
                  <input type="text" name="PostalCode" placeholder="Masukkan Kode Pos" class="form-control" value="<?php echo $updatePegawai['PostalCode'];?>">
                </div>
              </div>
              
              <!-- COUNTRY -->
              <div class="row">
                <div class="col-25">
                  <label>Negara</label>
                </div>
                <div class="col-75">
                  <input type="text" name="Country" placeholder="Masukkan Negara Asal" class="form-control" value="<?php echo $updatePegawai['Country'];?>">
                </div>
              </div>
              
              <!-- Status Kewarganegaraan -->
              <div class="row">
                <div class="col-25">
                  <label>Status Kewarganegaraan</label>
                </div>
                <div class="col-75">
                  <select id="Nationality" name="Nationality" class="form-control">
                    <option value="">Pilih Status Kewarganegaraan</option>
                    <option value="WNI" <?php echo ($updatePegawai['Nationality']=='WNI')?"selected":"";?>>Warga Negara Indonesia (WNI)</option>
                    <option value="WNA" <?php echo ($updatePegawai['Nationality']=='WNA')?"selected":"";?>>Warga Negara Asing (WNA)</option>
                  </select>
                </div>
              </div>
            
              <!-- REPORT TO-->
              <div class="row">
                  <div class="col-25">
                      <label>Report To</label>
                  </div>
                  <div class="col-75">
                      <select id="ReportsTo" placeholder="ReportsTo" data-allow-clear="1" name="ReportsTo" class="form-control">
                        <option>Pilih Atasan</option>
                        <?php
                            $LastReport = $updatePegawai['ReportsTo'];
                            $sqlReport = "SELECT * FROM employees WHERE EmployeeID = $LastReport";
                            $resultReport = mysqli_query($conn, $sqlReport);
                            $rowReport = mysqli_fetch_assoc($resultReport);
                            $ReportsTo = $rowReport['EmployeeID'];
                            $EmployeeName = $rowReport['FirstName']." ".$rowReport['LastName'];
						    
						    echo "<option value='$ReportsTo' selected='selected'>" . $EmployeeName ."</option>";
                        
                            $sql = "SELECT EmployeeID, CONCAT(FirstName, ' ', LastName, ' - ', Title) as Nama FROM employees WHERE LEVEL <=3 and EmployeeID<>'1101'";
                            $result = mysqli_query($conn, $sql);
        
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                   $ReportsTo = $row["EmployeeID"];
                                    echo "<option value='$ReportsTo'> " . $row["Nama"] ."</option>";
                                }
                            }
                        ?>
    
                    </select>
                  </div>
              </div>
              
              <?php
	            }
	        ?>

              <!-- BUTTON -->
              <br><br>
              <div align="right">
                <!--<button type="save" name="save" value="save" class="btn btn">Kembali</button>-->
                <button type="edit" name="edit" value="edit" class="btn btn-success">Simpan</button>
                <a class="btn btn-danger" href="master-pegawai.php" type="kembali">Kembali</a>
              </div>
              </form>
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

  <!-- FITUR SELECT2 PADA Title -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#Title").select2({
              placeholder: "Pilih Status Pegawai"
          });
      });
  </script>
  
  <!-- FITUR SELECT2 PADA Level -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#Level").select2({
              placeholder: "Pilih Tingkatan Pegawai (Sesuaikan Dengan Status)"
          });
      });
  </script>
  
  <!-- FITUR SELECT2 PADA TitleOfCourtesy -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#TitleOfCourtesy").select2({
              placeholder: "Pilih Title of Courtesy"
          });
      });
  </script>
  
  <!-- FITUR SELECT2 PADA tgl lahir -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#tgl").select2({
              
          });
      });
  </script>
  
  <!-- FITUR SELECT2 PADA bln lahir -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#bln").select2({
              
          });
      });
  </script>
  
  <!-- FITUR SELECT2 PADA thn lahir -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#thn").select2({
              
          });
      });
  </script>
  
  <!-- FITUR SELECT2 PADA tgl kerja -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#tgl2").select2({
              
          });
      });
  </script>
  
  <!-- FITUR SELECT2 PADA bln kerja -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#bln2").select2({
              
          });
      });
  </script>
  
  <!-- FITUR SELECT2 PADA thn kerja -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#thn2").select2({
              
          });
      });
  </script>
  
  <!-- FITUR SELECT2 PADA Nationality -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#Nationality").select2({
              
          });
      });
  </script>
  
  <!-- FITUR SELECT2 PADA ReportsTo -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#ReportsTo").select2({
              
          });
      });
  </script>    
    
</body>

</html>
