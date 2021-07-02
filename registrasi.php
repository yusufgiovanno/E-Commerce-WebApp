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

  <?php include 'head2.php'; ?>
  
  <!-- Custom styles for this tables -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
  <!-- Select2 -->
    <link rel="stylesheet" href="css/select2.min.css"/>
  <!-- select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <!-- select2-bootstrap4-theme -->
    <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet"> <!-- for live demo page -->
    <link href="select2-bootstrap4.css" rel="stylesheet">

</head>

<body id="page-top">

  <?php
  include "dist/db.php";
//    if (!isset($_SESSION['username'])) {
//        die("
//      <br><br><br><br>
//      <div class='row justify-content-center'>
//        <div class='col-xl-5 col-lg-12 col-md-9'>
//          <div class='card o-hidden border-0 shadow-lg my-5'>
//            <div class='card-body p-0'>
//              <!-- Nested Row within Card Body -->
//              <div class='row'>
//                <div class='col-lg-12'>
//                  <div class='p-5'>
//                    <div class='text-center'>
//                      <h1 class='h4 text-gray-900 mb-4'>
//                      Akses Ilegal !<br>
//                      Mohon Melakukan Login Terlebih Dahulu !
//                      </h1>
//                    </div>
//                    
//                    <a href='index.php' class='btn btn-danger btn-user btn-block'>
//                    Ke Menu Login
//                    </a> 
//
//                  </div>
//                </div>
//              </div>
//            </div>
//          </div>
//        </div>
//      </div>
//            ");
//    }

    $username = $_SESSION['username'];
    
    $tampilNama=mysqli_query($conn, "SELECT * FROM employees WHERE Username='$username'");
    $hasil=mysqli_fetch_array($tampilNama);
        $nama = $hasil['FirstName'] . ' ' . $hasil['LastName'];
    ?>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <!-- <i class="fas fa-laugh-wink"></i> -->
          <span class="logo-lg"><img src='img/Logo_Bio_Herbal_Kecil.png' alt='User Image' width="50px" height="50px"></span>
        </div>
        <div class="sidebar-brand-text mx-3">BIO HERBAL</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  
                </span>
                <!-- <img class="img-profile rounded-circle" src="img/no-image.jpg"> -->
              </a>
              
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <!-- <div class="dropdown-divider"></div> -->
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
        
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Registrasi</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
              
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Registrasi</h6>
            </div>
            
            <div class="container">
              <!-- Form -->
              <form action="cek-registrasi.php" method="POST">

              <!-- ID -->
              <div class="row">
                <div class="col-25">
                  <label>No. ID Pegawai <a style="color: red;">*</a></label>
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
                  <label>Nama Depan <a style="color: red;">*</a></label>
                </div>
                <div class="col-75">
                  <input type="text" name="FirstName" placeholder="Masukkan Nama Depan Pegawai" class="form-control">
                </div>
              </div>

              <!-- NAMA PEGAWAI -->
              <div class="row">
                <div class="col-25">
                  <label>Nama Belakang <a style="color: red;">*</a></label>
                </div>
                <div class="col-75">
                  <input type="text" name="LastName" placeholder="Masukkan Nama Belakang Pegawai" class="form-control">
                </div>
              </div>

              <!-- TITLE -->
              <div class="row">
                <div class="col-25">
                  <label>Jabatan <a style="color: red;">*</a></label>
                </div>
                <div class="col-75">
                  <select id="Title" name="Title" class="form-control">
                    <option value="">Pilih Jabatan Pegawai</option>
                    <!-- <option value="CEO">CEO</option> -->
                    <option value="Direktur">Direktur</option>
                    <option value="Area Manager">Area Manager</option>
                    <option value="Mitra Kerja">Mitra Kerja</option>
                  </select>
                </div>
              </div>
              
              <!-- Level -->
              <div class="row">
                <div class="col-25">
                  <label>Level Jabatan <a style="color: red;">*</a></label>
                </div>
                <div class="col-75">
                  <select id="Level" name="Level" class="form-control">
                    <option value="">Pilih Tingkatan Jabatan (Sesuaikan Dengan Status)</option>
                    <!-- <option value="1">1 = Admin</option> -->
                    <option value="2">2 = Direktur</option>
                    <option value="3">3 = Area Manager</option>
                    <option value="4">4 = Mitra Kerja</option>
                  </select>
                </div>
              </div>
              
               <!-- GENDER -->
              <div class="row">
                <div class="col-25">
                  <label>Title of Courtesy <a style="color: red;">*</a></label>
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
                  <label>Tanggal Lahir <a style="color: red;">*</a></label>
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
                  <label>Tanggal Mulai Bekerja <a style="color: red;">*</a></label>
                </div>
                <div class="col-15">
                    <select name="tgl_bekerja" size="1" id="tgl" class="form-control">
                          <?
                		     for ($i=1;$i<=31;$i++)
                			 {
                			   echo "<option value=".$i.">".$i."</option>";
                			 }
                		  ?>
                     </select>
                </div>
                
                <div class="col-15">
                    <select name="bln_bekerja" size="1" id="bln" class="form-control">
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
                    <select name="thn_bekerja" size="1" id="thn" class="form-control">
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
                  <label>Alamat Pegawai <a style="color: red;">*</a></label>
                </div>
                <div class="col-75">
                  <input type="text" name="Address" placeholder="Masukkan Alamat Lengkap Pegawai" class="form-control">
                </div>
              </div>
              
              <!-- HANDPHONE -->
              <div class="row">
                <div class="col-25">
                  <label>No. Handphone <a style="color: red;">*</a></label>
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
                  <label>Status Kewarganegaraan <a style="color: red;">*</a></label>
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
                  <label>Username <a style="color: red;">*</a></label>
                </div>
                <div class="col-75">
                  <input type="text" name="Username" placeholder="Masukkan Username Pegawai" class="form-control">
                </div>
              </div>
              
              <!-- PASSWORD -->
              <div class="row">
                <div class="col-25">
                  <label>Password <a style="color: red;">*</a></label>
                </div>
                <div class="col-75">
                  <input type="password" name="EmployeePassword" placeholder="Masukkan Password Pegawai" class="form-control">
                </div>
              </div>
              
              <!-- REPORT TO-->
              <div class="row">
                  <div class="col-25">
                      <label>Report To <a style="color: red;">*</a></label>
                  </div>
                  <div class="col-75">
                      <select placeholder="ReportsTo" data-allow-clear="1" name="ReportsTo" class="form-control">
                        <option>Pilih Atasan</option>
                        <?php
                            $sql = "SELECT EmployeeID, CONCAT(FirstName, ' ', LastName, ' - ', Title) as Nama FROM employees WHERE LEVEL <=3 AND Notes='Confirm' AND Title<>'Admin'";
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
                <a class="btn btn-danger" href="index.php" type="kembali">Kembali Ke Login</a>
              </div>
              </form>
            </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Bio Herbal 2020 Versi. Beta 1.0</span>
          </div>
        </div>
      </footer>
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin mau Logout?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">脳</span>
          </button>
        </div>
        <div class="modal-body">Tekan tombol "Logout" dibawah jika  sudah siap untuk mengakhiri sesi.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- FITUR SELECT2 PADA PROPINSI -->
  <!--<script src="js/select/select2.min.js"></script>-->
  <!--<script>-->
  <!--    $(document).ready(function () {-->
  <!--        $("#title").select2({-->
  <!--            placeholder: "Pilih Status Pegawai"-->
  <!--        });-->
  <!--    });-->
  <!--</script>-->
  
  <!-- FITUR SELECT2 PADA KOTA/KABUPATEN -->
  <!--<script src="js/select/select2.min.js"></script>-->
  <!--<script>-->
  <!--    $(document).ready(function () {-->
  <!--        $("#level").select2({-->
  <!--            placeholder: "Pilih Tingkatan Pegawai (Sesuaikan Dengan Status)"-->
  <!--        });-->
  <!--    });-->
  <!--</script>-->
  
  <!-- FITUR SELECT2 PADA KECAMATAN -->
  <!--<script src="js/select/select2.min.js"></script>-->
  <!--<script>-->
  <!--    $(document).ready(function () {-->
  <!--        $("#courtesy").select2({-->
  <!--            placeholder: "Pilih Title of Courtesy"-->
  <!--        });-->
  <!--    });-->
  <!--</script>-->
  
  <!-- FITUR SELECT2 PADA KELURAHAN -->
  <!--<script src="js/select/select2.min.js"></script>-->
  <!--<script>-->
  <!--    $(document).ready(function () {-->
  <!--        $("#status").select2({-->
  <!--            placeholder: "Pilih Status Kewarganegaraan"-->
  <!--        });-->
  <!--    });-->
  <!--</script>-->
  
   <!-- FITUR SELECT2 PADA JENIS PROTOTIPE -->
  <!--<script src="js/select/select2.min.js"></script>-->
  <!--<script>-->
  <!--    $(document).ready(function () {-->
  <!--        $("#prototipe").select2({-->
  <!--            placeholder: "Pilih Jenis Prototipe pada Alat"-->
  <!--        });-->
  <!--    });-->
  <!--</script>-->
    </div>
</body>

</html>