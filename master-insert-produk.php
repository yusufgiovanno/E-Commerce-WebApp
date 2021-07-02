<?php
  session_start();
  $thisPage = "master-products"; 
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
            <h1 class="h3 mb-0 text-gray-800">Tambah Produk Baru</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
              
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tambah Produk Baru</h6>
            </div>
            
            <div class="container">
              <!-- Form -->
              <form action="cek-insert-produk.php" method="POST" enctype="multipart/form-data">
                  
              <!-- ID Produk -->
              <div class="row">
                <div class="col-25">
                  <label>No. ID Produk<a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                    <?php
                            $sql = "SELECT ProductID + 1 as IDProduct FROM products ORDER BY IDProduct DESC LIMIT 1 ";
                            $result = mysqli_query($conn, $sql);
        
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                    $ProductID = $row["IDProduct"];
                                    echo "<input type='text' name='ProductID' value='$ProductID'  class='form-control' readonly>";
                                }
                            }
                        ?>
                  <!-- <input type="text" name="ProductID" placeholder="Masukkan No Product" class="form-control"> -->
                </div>
              </div>    
                
              <!-- Nama Produk -->
              <div class="row">
                <div class="col-25">
                  <label>Nama Produk<a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <input type="text" name="ProductName" placeholder="Masukkan Nama Produk" class="form-control">
                </div>
              </div>

              <!-- Remark Produk -->
              <div class="row">
                <div class="col-25">
                  <label>Keterangan Produk<a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <!--<input type="text" name="RemarkProduct" placeholder="Masukkan Keterangan Produk" class="form-control">-->
                  <!-- Untuk mengatur lebarnya ubah angka di bagian 'rows=""' (rows="5"[untuk saat ini]) -->
                  <textarea name="RemarkProduct" placeholder="Masukkan Keterangan Produk" class="form-control" cols="40" rows="6"></textarea>
                </div>
              </div>
              
              <!-- Category ID -->
              <div class="row">
                  <div class="col-25">
                      <label>Category<a style="color: red;">*</label></a>
                  </div>
                  <div class="col-75">
                      <select id="category" placeholder="Category" data-allow-clear="1" name="CategoryID" class="form-control">
                        <option>Pilih Kategori</option>
                        <?php
                            $sql = "SELECT CategoryID, CategoryName FROM categories";
                            $result = mysqli_query($conn, $sql);
        
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                    // $cid = $row["CustomerID"];
                                    // echo "<option value='$cid'>" . $row["CategoryID"]. " - " . $row["CategoryName"] ."</option>";
                                    $CategoryID = $row["CategoryID"];
                                    echo "<option value='$CategoryID'>" . $row["CategoryID"]. " - " . $row["CategoryName"] ."</option>";
                                }
                            }
                        ?>
    
                    </select>
                  </div>
              </div>
                            
              <!--Satuan  Produk --> 
              <div class="row"> 
                <div class="col-25">
                  <label>Satuan Produk<a style="color: red;">*</label></a> 
               </div> 
               <div class="col-75"> 
                 <input type="text" name="QuantityPerUnit" placeholder="Masukkan Satuan Produk" class="form-control"> 
                </div> 
              </div> 
              
              <!-- Sale Price -->
              <div class="row">
                <div class="col-25">
                  <label>Harga Jual<a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <input type="text" name="SalePrice" placeholder="Masukkan Harga Jual" class="form-control">
                </div>
              </div>
              
              <!-- Unit Price -->
              <div class="row">
                <div class="col-25">
                  <label>Harga Barang<a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <input type="text" name="UnitPrice" placeholder="Masukkan Harga Barang" class="form-control">
                </div>
              </div>
              
              <!-- Discount -->
              <div class="row">
                <div class="col-25">
                  <label>Discount</label>
                </div>
                <div class="col-75">
                  <input type="text" name="Discon" placeholder="Masukkan Nilai Diskon" class="form-control">
                </div>
              </div>
              
              <!-- Unit In Stock -->
              <div class="row">
                <div class="col-25">
                  <label>Stok Awal<a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <input type="text" name="UnitsInStock" placeholder="Masukkan Stok awal" class="form-control">
                </div>
              </div>
              
              <!-- Min Stock -->
              <div class="row">
                <div class="col-25">
                  <label>Min. Stok Order<a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <input type="text" name="MinStock" placeholder="Masukkan Minimal Stok Untuk Order Kembali" class="form-control">
                </div>
              </div>
              
              <!-- Reorder Level -->
              <div class="row">
                <div class="col-25">
                  <label>Min. Barang Order<a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <input type="text" name="ReorderLevel" placeholder="Masukkan Jumlah Barang Minimal Untuk Order" class="form-control">
                </div>
              </div>
              
               <!-- Expired Date -->
               <div class="row">
                <div class="col-25">
                  <label>Kadaluarsa<a style="color: red;">*</label></a>
                </div>
                <!-- Buat Tanggal -->
                <div class="col-15">
                    <select name="tgl_Expired" size="1" id="tgl" class="form-control">
                          <?
                		     for ($i=1;$i<=31;$i++)
                			 {
                			   $tgl_Expired = $i;
                			   echo "<option value='$tgl_Expired'>" . $tgl_Expired . "</option>";
                			 }
                		  ?>
                     </select>
                </div>
                <!-- Buat Bulan -->
                <div class="col-15">
                    <select name="bln_Expired" size="1" id="bln" class="form-control">
                          <?
                		     $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                		     for ($i=1;$i<=12;$i++)
                			 {
                			   $bln_Expired = $i;
                			   echo "<option value='$bln_Expired'>" . $bulan[$i] . "</option>";
                			 }
                		  ?>
                	</select>
                </div>
                <!-- Buat Tahun -->
                <div class="col-15">
                    <select name="thn_Expired" size="1" id="thn" class="form-control">
                          <?
                		     for ($i=2020;$i<=2100;$i++)
                			 {
                			   $thn_Expired = $i;
                			   echo "<option value='$thn_Expired'>" . $thn_Expired . "</option>";
                			 }
                		  ?>
                     </select>
                </div> 
              </div>
              
              <!-- Discontinued -->
              <!--<div class="row">
                <div class="col-25">
                  <label>Discontinued Produk<a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <select id="Discontinued" name="Discontinued" class="form-control">
                    <option value="">Pilih Status Produk (Sesuaikan Dengan Status)</option>
                    <option value="n">N= Active</option>
                    <option value="y">Y = Discontinued</option>
                  </select>
                </div>
              </div>
              
              <!-- Satuan Terkecil -->
              <!--<div class="row">
                <div class="col-25">
                  <label>Satuan Terkecil<a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                  <select id="SatuanTerkecil" name="SatuanTerkecil" class="form-control">
                    <option value="">Pilih Apakah Product sudah menggunakan satuan terkecil</option>
                    <option value="y">Y= Ya</option>
                    <option value="n">N = Tidak</option>
                  </select>
                </div>
              </div>
              
              <!-- Gambar -->
              <div class="row">
                <div class="col-25">
                  <label>Gambar <a style="color: red;">*</label></a>
                </div>
                <div class="col-75">
                   <input type="file" name="Gambar">
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
                <a href="master-produk.php" class="btn btn-danger">Kembali</a>
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

  <!-- FITUR SELECT2 PADA PROPINSI -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#category").select2({
              placeholder: "Pilih Kategori"
          });
      });
  </script>
  
  <!-- FITUR SELECT2 PADA TANGGAL -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#tgl").select2({
            //   placeholder: "Pilih Tingkatan Pegawai (Sesuaikan Dengan Status)"
          });
      });
  </script>
  
  <!-- FITUR SELECT2 PADA BULAN -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#bln").select2({
            //   placeholder: "Pilih Title of Courtesy"
          });
      });
  </script>
  
  <!-- FITUR SELECT2 PADA KELURAHAN -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#thn").select2({
            //   placeholder: "Pilih Status Kewarganegaraan"
          });
      });
  </script>
  
   <!-- FITUR SELECT2 PADA JENIS PROTOTIPE -->
  <!--<script src="js/select/select2.min.js"></script>-->
  <!--<script>-->
  <!--    $(document).ready(function () {-->
  <!--        $("#prototipe").select2({-->
  <!--            placeholder: "Pilih Jenis Prototipe pada Alat"-->
  <!--        });-->
  <!--    });-->
  <!--</script>-->

</body>

</html>
