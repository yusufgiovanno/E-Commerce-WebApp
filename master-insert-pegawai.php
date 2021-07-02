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
            <h1 class="h3 mb-0 text-gray-800">Tambah Pegawai</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
              
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tambah Pegawai</h6>
            </div>
            
            <div class="container">
              <!-- Form -->
              <form action="cek-insert-pegawai.php" method="POST">

              <!-- ID -->
              <div class="row">
                <div class="col-25">
                  <label>No. ID Pegawai <a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                    <?php
                            $sql = "SELECT EmployeeID + 1 as IDEmployee FROM employees ORDER BY EmployeeID DESC LIMIT 1 ";
                            $result = mysqli_query($conn, $sql);
        
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                    $EmployeeID = $row["IDEmployee"];
                                    echo "<input type='text' name='EmployeeID' value='$EmployeeID'  class='form-control' readonly>";
                                }
                            }
                        ?>
                  <!--<input type="text" name="EmployeeID" placeholder="Masukkan ID Pegawai" class="form-control"> -->
                </div>
              </div>    
                
              <!-- Nama Depan -->
              <div class="row">
                <div class="col-25">
                  <label>Nama Depan <a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <input type="text" name="FirstName" placeholder="Masukkan Nama Depan Pegawai" class="form-control">
                </div>
              </div>

              <!-- NAMA PEGAWAI -->
              <div class="row">
                <div class="col-25">
                  <label>Nama Belakang <a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <input type="text" name="LastName" placeholder="Masukkan Nama Belakang Pegawai" class="form-control">
                </div>
              </div>

              <!-- TITLE -->
              <div class="row">
                <div class="col-25">
                  <label>Jabatan <a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <select id="Title" name="Title" class="form-control">
                    <option value="">Pilih Jabatan Pegawai</option>
                    <option value="CEO">CEO</option>
                    <option value="Direktur">Direktur</option>
                    <option value="Area Manager">Area Manager</option>
                    <option value="Mitra Kerja">Mitra Kerja</option>
                  </select>
                </div>
              </div>
              
              <!-- Level -->
              <div class="row">
                <div class="col-25">
                  <label>Level Jabatan <a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <select id="Level" name="Level" class="form-control">
                    <option value="">Pilih Tingkatan Jabatan (Sesuaikan Dengan Status)</option>
                    <option value="1">1 = CEO</option>
                    <option value="2">2 = Direktur</option>
                    <option value="3">3 = Area Manager</option>
                    <option value="4">4 = Mitra Kerja</option>
                  </select>
                </div>
              </div>
              
               <!-- GENDER -->
              <div class="row">
                <div class="col-25">
                  <label>Title of Courtesy <a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <select id="TitleOfCourtesy" name="TitleOfCourtesy" class="form-control">
                    <option value="">Pilih Title of Courtesy</option>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Miss">Miss</option>
                  </select>
                </div>
              </div>
              
              <!-- TANGGAL LAHIR -->
              <div class="row">
                <div class="col-25">
                  <label>Tanggal Lahir <a style="color: red;">*</label></a>
                </div>
                <div class="col-15">
                    <select name="tgl_lahir" size="1" id="tgl" class="form-control">
                          <?
                		     for ($i=1;$i<=31;$i++)
                			 {
                			   echo "<option value=".$i.">".$i."</option>";
                			 }
                		  ?>
                     </select>
                </div>
                
                <div class="col-15">
                    <select name="bln_lahir" size="1" id="bln" class="form-control">
                          <?
                		     $bulan=array("","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                		     for ($i=1;$i<=12;$i++)
                			 {
                			   echo "<option value=".$i.">".$bulan[$i]."</option>";
                			 }
                		  ?>
                	</select>
                </div>
                
                <div class="col-15">
                    <select name="thn_lahir" size="1" id="thn" class="form-control">
                          <?
                		     for ($i=1985;$i<=2000;$i++)
                			 {
                			   echo "<option value=".$i.">".$i."</option>";
                			 }
                		  ?>
                     </select>
                </div>       
                        
              </div>
              
              <!-- TANGGAL KERJA -->
              <div class="row">
                <div class="col-25">
                  <label>Tanggal Mulai Bekerja <a style="color: red;">*</label></a>
                </div>
                <div class="col-15">
                    <select name="tgl_bekerja" size="1" id="tgl2" class="form-control">
                          <?
                		     for ($i=1;$i<=31;$i++)
                			 {
                			   echo "<option value=".$i.">".$i."</option>";
                			 }
                		  ?>
                     </select>
                </div>
                
                <div class="col-15">
                    <select name="bln_bekerja" size="1" id="bln2" class="form-control">
                          <?
                		     $bulan=array("","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                		     for ($i=1;$i<=12;$i++)
                			 {
                			   echo "<option value=".$i.">".$bulan[$i]."</option>";
                			 }
                		  ?>
                	</select>
                </div>
                
                <div class="col-15">
                    <select name="thn_bekerja" size="1" id="thn2" class="form-control">
                          <?
                		     for ($i=2000;$i<=2100;$i++)
                			 {
                			   echo "<option value=".$i.">".$i."</option>";
                			 }
                		  ?>
                     </select>
                </div>  
              </div>
              
              <!-- ALAMAT PEGAWAI -->
              <div class="row">
                <div class="col-25">
                  <label>Alamat Pegawai <a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <input type="text" name="Address" placeholder="Masukkan Alamat Lengkap Pegawai" class="form-control">
                </div>
              </div>
              
              <!-- HANDPHONE -->
              <div class="row">
                <div class="col-25">
                  <label>No. Handphone <a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <input type="text" name="Phone" placeholder="Masukkan Nomor Handphone Pegawai" class="form-control">
                </div>
              </div>
              
              <!-- KOTA ASAL -->
              <div class="row">
                <div class="col-25">
                  <label>Kota/Kabupaten</label>
                </div>
                <div class="col-75">
                  <input type="text" name="City" placeholder="Masukkan Kota/Kabupaten" class="form-control">
                </div>
              </div>
              
              <!-- PROPINSI ASAL -->
              <div class="row">
                <div class="col-25">
                  <label>Propinsi</label>
                </div>
                <div class="col-75">
                  <input type="text" name="Region" placeholder="Masukkan Propinsi" class="form-control">
                </div>
              </div>
              
              <!-- KODE POS -->
              <div class="row">
                <div class="col-25">
                  <label>Kode Pos</label>
                </div>
                <div class="col-75">
                  <input type="text" name="PostalCode" placeholder="Masukkan Kode Pos" class="form-control">
                </div>
              </div>
              
              <!-- COUNTRY -->
              <div class="row">
                <div class="col-25">
                  <label>Negara</label>
                </div>
                <div class="col-75">
                  <input type="text" name="Country" placeholder="Masukkan Negara Asal" class="form-control">
                </div>
              </div>
              
              <!-- Status Kewarganegaraan -->
              <div class="row">
                <div class="col-25">
                  <label>Status Kewarganegaraan <a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <select id="Nationality" name="Nationality" class="form-control">
                    <option value="">Pilih Status Kewarganegaraan</option>
                    <option value="WNI">Warga Negara Indonesia (WNI)</option>
                    <option value="WNA">Warga Negara Asing (WNA)</option>
                  </select>
                </div>
              </div>
              
              <!-- USERNAME -->
              <div class="row">
                <div class="col-25">
                  <label>Username <a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <input type="text" name="Username" placeholder="Masukkan Username Pegawai" class="form-control">
                </div>
              </div>
              
              <!-- PASSWORD -->
              <div class="row">
                <div class="col-25">
                  <label>Password <a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <input type="password" name="EmployeePassword" placeholder="Masukkan Password Pegawai" class="form-control">
                </div>
              </div>
              
              <!-- REPORT TO-->
              <div class="row">
                  <div class="col-25">
                      <label>Report To <a style="color: red;">*</label></a>
                  </div>
                  <div class="col-75">
                      <select id="ReportsTo" placeholder="ReportsTo" data-allow-clear="1" name="ReportsTo" class="form-control">
                        <option>Pilih Atasan</option>
                        <?php
                            $sql = "SELECT EmployeeID, CONCAT(FirstName, ' ', LastName, ' - ', Title) as Nama FROM employees WHERE LEVEL <=3 AND EmployeeID<>'1101'";
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
                  
              <!-- * -->
              <div class="row">
                <div class="col-25">
                </div>
                <div align="right" class="col-75">
                  <label><a style="color: red;">*</a> Wajib Diisi</label>
                </div>
              </div>

              <!-- BUTTON -->
              <br>
              <div align="right">
                <button type="save" name="save" value="save" class="btn btn-success">Simpan</button>
                <a href="master-pegawai.php" class="btn btn-danger">Kembali</a>
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
