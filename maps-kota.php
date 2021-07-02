<?php
  session_start();
  $thisPage = "maps-kota"; 
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
            <h1 class="h3 mb-0 text-gray-800">Mapping Sales</h1>
          </div>
          
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
              
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mapping Sales on City</h6>
              </div>
          
          <!-- Content Row Untuk Menu Dashboard -->

              <div class="row">
    
                <!-- Monitoring Maps -->
                <div class="col-xl-12 col-lg-7">
                    <div id="googleMaps" style="width:100%;height: 484px;position:relative;"></div>
                </div>
    
              <!-- /. row -->
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin mau Logout?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span class="fa fa-window-close" aria-hidden="true"></span>
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
  
  <!-- Google Maps Script -->
  <script>
    var marker;
      function initialize() {
        
        var mapOptions = {
          zoom:8,
          gestureHandling: 'greedy',
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }  
        var mapCanvas = document.getElementById('googleMaps');
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var infoWindow = new google.maps.InfoWindow;      
        var bounds = new google.maps.LatLngBounds();
 
        function bindInfoWindow(marker, map, infoWindow, html) {
          google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
          });
        }
 
          function addMarker(lat, lng, xtitle,xlabel, info) {
            var pt = new google.maps.LatLng(lat, lng);
            bounds.extend(pt);
            var marker = new google.maps.Marker({
                map: map,
                position:pt,
                title: xtitle,
                label: xlabel
                
            });       
            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, info);
          }
 
          <?php
            if($lv <= 2){
                $query = mysqli_query($conn, "SELECT kot.KotaID,Kota, kot.Latitude,kot.Longitude, IF(SUM(sd.Quantity) IS NULL,0,SUM(sd.Quantity)) AS Jumlah_Barang FROM daftarkota kot join daftarkecamatan kec on(kot.KotaID=kec.KotaID) join daftar_kelurahan dk ON(kec.KecID=dk.KecID) JOIN customers c ON (dk.KelID=c.KelID) JOIN sales s ON (c.CustomerID=s.CustomerID) JOIN sales_details sd ON(s.SalesID=sd.SalesID) WHERE kot.Latitude<>0 AND kot.Longitude<>0 AND YEAR(SaleDate)=YEAR(CURRENT_DATE)  GROUP BY Kota ");
            }
            elseif($lv == 3){
                $query = mysqli_query($conn, "SELECT kot.KotaID,Kota, kot.Latitude,kot.Longitude, IF(SUM(sd.Quantity) IS NULL,0,SUM(sd.Quantity)) AS Jumlah_Barang FROM daftarkota kot join daftarkecamatan kec on(kot.KotaID=kec.KotaID) join daftar_kelurahan dk ON(kec.KecID=dk.KecID) JOIN customers c ON (dk.KelID=c.KelID) JOIN sales s ON (c.CustomerID=s.CustomerID) JOIN sales_details sd ON(s.SalesID=sd.SalesID) JOIN employees e ON (s.EmployeeID=e.EmployeeID) WHERE (s.employeeID IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') OR s.employeeID='$eid') AND kot.Latitude<>0 AND kot.Longitude<>0 AND YEAR(SaleDate)=YEAR(CURRENT_DATE)  GROUP BY Kota ");
            }
            else{
                $query = mysqli_query($conn, "SELECT kot.KotaID,Kota, kot.Latitude,kot.Longitude, IF(SUM(sd.Quantity) IS NULL,0,SUM(sd.Quantity)) AS Jumlah_Barang FROM daftarkota kot join daftarkecamatan kec on(kot.KotaID=kec.KotaID) join daftar_kelurahan dk ON(kec.KecID=dk.KecID) JOIN customers c ON (dk.KelID=c.KelID) JOIN sales s ON (c.CustomerID=s.CustomerID) JOIN sales_details sd ON(s.SalesID=sd.SalesID) WHERE kot.Latitude<>0 AND kot.Longitude<>0 AND YEAR(SaleDate)=YEAR(CURRENT_DATE) AND s.EmployeeID='$eid' GROUP BY Kota ");
            }
            $ID=array();
            $lat=array();
            $lon=array();
            $nama=array();
            $ttlBarang=array();
            $Note=array();
            $i=0;
            while ($data = mysqli_fetch_array($query)) {
              $ID[$i] = $data['KotaID'];
              $lat[$i] = $data['Latitude'];
              $lon[$i] = $data['Longitude'];
              $nama[$i] = $data['Kelurahan'];
              $ttlBarang[$i] = $data['Jumlah_Barang'];
              $Note[$i]="<br><div><b>Info Detail di $nama[$i]</b></div></br>";
              $i++; 
            }
            $arrlength = count($lat);
            for($i = 0; $i < $arrlength; $i++) {
                if ($lat[$i] != 0 && $lon[$i] !=0) {
                    $Note[$i] = "$Note[$i] <div><b>Info Penjualan</b></div>";
                    if($lv <= 2){
                         $query = mysqli_query($conn, "SELECT ProductName, SUM(Quantity) Total_Barang FROM sales_details sd JOIN products p ON(sd.productID=p.productID) JOIN sales s ON(s.salesID=sd.salesID) JOIN customers c ON(s.customerID=c.customerID) JOIN daftar_kelurahan dk ON(c.KelID=dk.KelID) join daftarkecamatan kec ON(kec.KecID=dk.KecID) JOIN daftarkota kot on(kot.KotaID=kec.KotaID) WHERE kot.KotaID='$ID[$i]' AND YEAR(saleDate)=YEAR(CURRENT_DATE) GROUP BY ProductName ORDER BY Total_Barang DESC ");
                     }
                     elseif($lv == 3){
                         $query = mysqli_query($conn, "SELECT ProductName, SUM(Quantity) Total_Barang FROM sales_details sd JOIN products p ON(sd.productID=p.productID) JOIN sales s ON(s.salesID=sd.salesID) JOIN customers c ON(s.customerID=c.customerID) JOIN daftar_kelurahan dk ON(c.KelID=dk.KelID) join daftarkecamatan kec ON(kec.KecID=dk.KecID) JOIN daftarkota kot on(kot.KotaID=kec.KotaID) WHERE (s.employeeID IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') OR s.employeeID='$eid') AND kot.KotaID='$ID[$i]' AND YEAR(saleDate)=YEAR(CURRENT_DATE) GROUP BY ProductName ORDER BY Total_Barang DESC ");
                     }
                     else{
                         $query = mysqli_query($conn, "SELECT ProductName, SUM(Quantity) Total_Barang FROM sales_details sd JOIN products p ON(sd.productID=p.productID) JOIN sales s ON(s.salesID=sd.salesID) JOIN customers c ON(s.customerID=c.customerID) JOIN daftar_kelurahan dk ON(c.KelID=dk.KelID) join daftarkecamatan kec ON(kec.KecID=dk.KecID) JOIN daftarkota kot on(kot.KotaID=kec.KotaID) WHERE s.employeeID='$eid' AND kot.KotaID='$ID[$i]' AND YEAR(saleDate)=YEAR(CURRENT_DATE) GROUP BY ProductName ORDER BY Total_Barang DESC ");
                     }
                    
                    $x=0;
                    while ($data = mysqli_fetch_array($query)) {
                        $ProductName = $data['ProductName'];
                        $tBarang = $data['Total_Barang'];
                        $Note[$i] = "$Note[$i] <div>- $ProductName : $tBarang</div>";
                        $x++;
                    }
                    
                    $Note[$i] = "$Note[$i] <div><b>Info Program Ref</b></div>";
                    if($lv <= 2){
                        $query = mysqli_query($conn, "SELECT infoProgRadio, COUNT(infoProgRadio) AS Total_Info FROM sales s JOIN customers c ON(s.customerID=c.customerID) JOIN daftar_kelurahan dk ON(c.KelID=dk.KelID) join daftarkecamatan kec ON(kec.KecID=dk.KecID) JOIN daftarkota kot on(kot.KotaID=kec.KotaID) WHERE kot.KotaID='$ID[$i]' AND YEAR(saleDate)=YEAR(CURRENT_DATE) GROUP BY infoProgRadio ORDER BY Total_Info DESC ");
                     }
                     elseif($lv == 3){
                         $query = mysqli_query($conn, "SELECT infoProgRadio, COUNT(infoProgRadio) AS Total_Info FROM sales s JOIN customers c ON(s.customerID=c.customerID) JOIN daftar_kelurahan dk ON(c.KelID=dk.KelID) join daftarkecamatan kec ON(kec.KecID=dk.KecID) JOIN daftarkota kot on(kot.KotaID=kec.KotaID) WHERE (s.employeeID IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') OR s.employeeID='$eid') AND  kot.KotaID='$ID[$i]' AND YEAR(saleDate)=YEAR(CURRENT_DATE) GROUP BY infoProgRadio ORDER BY Total_Info DESC ");
                     }
                     else{
                         $query = mysqli_query($conn, "SELECT infoProgRadio, COUNT(infoProgRadio) AS Total_Info FROM sales s JOIN customers c ON(s.customerID=c.customerID) JOIN daftar_kelurahan dk ON(c.KelID=dk.KelID) join daftarkecamatan kec ON(kec.KecID=dk.KecID) JOIN daftarkota kot on(kot.KotaID=kec.KotaID) WHERE s.employeeID='$eid' AND kot.KotaID='$ID[$i]' AND YEAR(saleDate)=YEAR(CURRENT_DATE) GROUP BY infoProgRadio ORDER BY Total_Info DESC ");
                     }
                    $x=0;
                    while ($data = mysqli_fetch_array($query)) {
                        $Prog = $data['infoProgRadio'];
                        $tProg = $data['Total_Info'];
                        $Note[$i] = "$Note[$i] <div>- $Prog : $tProg</div>";
                        $x++;
                    }
                    $Note[$i] = "$Note[$i] <div><b>Info Usia Pembeli</b></div>";
                    if($lv <= 2){
                        $query = mysqli_query($conn, "SELECT IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=5,'Balita',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=11,'Anak',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=25,'Remaja',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=45,'Dewasa',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=65,'Lansia','Manula'))))) AS Jenis_Usia, COUNT(IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=5,'Balita',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=11,'Anak',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=25,'Remaja',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=45,'Dewasa',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=65,'Lansia','Manula')))))) AS Total_Jenis_Usia FROM sales s  JOIN customers c ON(s.customerID=c.customerID) JOIN daftar_kelurahan dk ON(c.KelID=dk.KelID) join daftarkecamatan kec ON(kec.KecID=dk.KecID) JOIN daftarkota kot on(kot.KotaID=kec.KotaID) WHERE kot.KotaID='$ID[$i]' AND YEAR(saleDate)=YEAR(CURRENT_DATE) GROUP BY Jenis_Usia ORDER BY Total_Jenis_Usia DESC ");
                     }
                     elseif($lv == 3){
                         $query = mysqli_query($conn, "SELECT IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=5,'Balita',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=11,'Anak',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=25,'Remaja',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=45,'Dewasa',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=65,'Lansia','Manula'))))) AS Jenis_Usia, COUNT(IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=5,'Balita',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=11,'Anak',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=25,'Remaja',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=45,'Dewasa',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=65,'Lansia','Manula')))))) AS Total_Jenis_Usia FROM sales s  JOIN customers c ON(s.customerID=c.customerID) JOIN daftar_kelurahan dk ON(c.KelID=dk.KelID) join daftarkecamatan kec ON(kec.KecID=dk.KecID) JOIN daftarkota kot on(kot.KotaID=kec.KotaID) WHERE (s.employeeID IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') OR s.employeeID='$eid') AND kot.KotaID='$ID[$i]' AND YEAR(saleDate)=YEAR(CURRENT_DATE) GROUP BY Jenis_Usia ORDER BY Total_Jenis_Usia DESC ");
                     }
                     else{
                         $query = mysqli_query($conn, "SELECT IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=5,'Balita',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=11,'Anak',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=25,'Remaja',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=45,'Dewasa',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=65,'Lansia','Manula'))))) AS Jenis_Usia, COUNT(IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=5,'Balita',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=11,'Anak',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=25,'Remaja',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=45,'Dewasa',IF(ROUND(DATEDIFF(NOW(),Tgl_Lahir)/365,0)<=65,'Lansia','Manula')))))) AS Total_Jenis_Usia FROM sales s  JOIN customers c ON(s.customerID=c.customerID) JOIN daftar_kelurahan dk ON(c.KelID=dk.KelID) join daftarkecamatan kec ON(kec.KecID=dk.KecID) JOIN daftarkota kot on(kot.KotaID=kec.KotaID) WHERE s.employeeID='$eid' AND kot.KotaID='$ID[$i]' AND YEAR(saleDate)=YEAR(CURRENT_DATE) GROUP BY Jenis_Usia ORDER BY Total_Jenis_Usia DESC ");
                     }
                    
                    $x=0;
                    while ($data = mysqli_fetch_array($query)) {
                        $age = $data['Jenis_Usia'];
                        $tAge = $data['Total_Jenis_Usia'];
                        $Note[$i] = "$Note[$i] <div>- $age : $tAge</div>";
                        $x++;
                    }
                    $Note[$i] = "$Note[$i] <div><b>Info Sakit</b></div>";
                    if($lv <= 2){
                        $query = mysqli_query($conn, "SELECT Sakit, COUNT(sakit) AS Total_Sakit FROM sales s JOIN customers c ON(s.customerID=c.customerID) JOIN detailsakit ds ON(c.customerID=ds.customerID) JOIN daftar_kelurahan dk ON(c.KelID=dk.KelID) join daftarkecamatan kec ON(kec.KecID=dk.KecID) JOIN daftarkota kot on(kot.KotaID=kec.KotaID) WHERE kot.KotaID='$ID[$i]' AND YEAR(saleDate)=YEAR(CURRENT_DATE) GROUP BY Sakit ORDER BY Total_Sakit DESC ");
                     }
                     elseif($lv == 3){
                         $query = mysqli_query($conn, "SELECT Sakit, COUNT(sakit) AS Total_Sakit FROM sales s JOIN customers c ON(s.customerID=c.customerID) JOIN detailsakit ds ON(c.customerID=ds.customerID) JOIN daftar_kelurahan dk ON(c.KelID=dk.KelID) join daftarkecamatan kec ON(kec.KecID=dk.KecID) JOIN daftarkota kot on(kot.KotaID=kec.KotaID) WHERE (s.employeeID IN (SELECT employeeID FROM employees WHERE ReportsTo='$eid') OR s.employeeID='$eid') AND kot.KotaID='$ID[$i]' AND YEAR(saleDate)=YEAR(CURRENT_DATE) GROUP BY Sakit ORDER BY Total_Sakit DESC ");
                     }
                     else{
                         $query = mysqli_query($conn, "SELECT Sakit, COUNT(sakit) AS Total_Sakit FROM sales s JOIN customers c ON(s.customerID=c.customerID) JOIN detailsakit ds ON(c.customerID=ds.customerID) JOIN daftar_kelurahan dk ON(c.KelID=dk.KelID) join daftarkecamatan kec ON(kec.KecID=dk.KecID) JOIN daftarkota kot on(kot.KotaID=kec.KotaID) WHERE s.employeeID='$eid' AND kot.KotaID='$ID[$i]' AND YEAR(saleDate)=YEAR(CURRENT_DATE) GROUP BY Sakit ORDER BY Total_Sakit DESC ");
                     }
                    
                    $x=0;
                    while ($data = mysqli_fetch_array($query)) {
                        $sick = $data['Sakit'];
                        $tSick = $data['Total_Sakit'];
                        $Note[$i] = "$Note[$i] <div>- $sick : $tSick</div>";
                        $x++;
                    }
                    echo ("addMarker($lat[$i], $lon[$i],'$nama[$i]','$ttlBarang[$i]', '<b>$Note[$i]</b>');\n"); 
                    
                    
                }
            }
          ?>
          
        // Set zoom level
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(8);
            google.maps.event.removeListener(boundsListener);
        });
      }
      
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  
  <!-- Maps API -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAEGGw0nGGqnYP2LR53UaoHHor_HCSdVeQ&libraries=places&callback=initialize"></script>


  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  

</body>

</html>
