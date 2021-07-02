<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <style>
  .sub,
  .add{
  font-weight: bold;
  height: 38px;
  padding: 0;
  width: 38px;
  position: relative;
  }
  </style>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BioHerbal Product</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Select2 -->
  <link rel="stylesheet" href="css/select2.min.css"/>

  <!-- Custom styles for this tables -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Script Auto Refresh -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js" type="text/javascript"></script>

  <!-- Script Js Google Maps -->
  <script src="http://maps.googleapis.com/maps/api/js"></script>

  <!-- Script Reload - Google Maps -->
<!--   <script type="text/javascript">
    var auto_refresh = setInterval(
      function () {
        $('#load-history').load('tables.php').fadeIn("slow");
      }, 40000);
  </script>
 -->

</head>

<body id="page-top">

  <?php
  session_start();
  include "dist/db.php";
    /*if (!isset($_SESSION['username'])) {
        die("
      <br><br><br><br>
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
                      Akses Ilegal !<br>
                      Mohon Melakukan Login Terlebih Dahulu !
                      </h1>
                    </div>

                    <a href='index.php' class='btn btn-danger btn-user btn-block'>
                    Ke Menu Login
                    </a>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
            ");
    }*/
    
     $username = $_SESSION['username'];
    
    $tampilNama=mysqli_query($conn, "SELECT * FROM employees WHERE Username='$username'");
    $hasil=mysqli_fetch_array($tampilNama);
        $nama = $hasil['FirstName'] . ' ' . $hasil['LastName'];
    
    class Item{
     var $id;
     var $name;
     var $price;
     var $quantity;
    }
    
    if (count($cart)==0){
        $_SESSION['next'] = 0;
    }
    
    if(isset($_GET['id']) && !isset($_POST['update']))  {
      $sql = "SELECT * FROM products WHERE ProductID=".$_GET['id'];
      $result = mysqli_query($conn, $sql);
      $product = mysqli_fetch_object($result);
      $item = new Item();
      $item->id = $product->ProductID;
      $item->name = $product->ProductName;
      $item->price = $product->SalePrice;
      $iteminstock = $product->QuantityPerUnit;
      $item->quantity = 1;
      // Check product is existing in cart
      $index = -1;
      $cart = unserialize(serialize($_SESSION['cart'])); // set $cart as an array, unserialize() converts a string into array
      for($i=0; $i<count($cart);$i++)
        if ($cart[$i]->id == $_GET['id']){
          $index = $i;
          break;
        }
        if($index == -1)
          $_SESSION['cart'][] = $item; // $_SESSION['cart']: set $cart as session variable
        else {

          if (($cart[$index]->quantity) < $iteminstock)
             $cart[$index]->quantity ++;
               $_SESSION['cart'] = $cart;
        }
    }
    // Delete product in cart
    if(isset($_GET['index']) && !isset($_POST['update'])) {
      $cart = unserialize(serialize($_SESSION['cart']));
      unset($cart[$_GET['index']]);
      $cart = array_values($cart);
      $_SESSION['cart'] = $cart;
      $_SESSION['next'] = 1;
    }
    // Update quantity in cart
    if(isset($_POST['update'])) {
      $arrQuantity = $_POST['quantity'];
      $cart = unserialize(serialize($_SESSION['cart']));
      for($i=0; $i<count($cart);$i++) {
         $cart[$i]->quantity = $arrQuantity[$i];
      }
      $_SESSION['cart'] = $cart;
        $_SESSION['next'] = 1;
    }
    if(isset($_GET["id"]) || isset($_GET["index"])){
     header('Location: cart.php');
    }
    ?>
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon">
          <!-- <i class="fas fa-laugh-wink"></i> -->
          <span class="logo-lg"><img src='img/Logo_Bio_Herbal_Kecil.png' alt='User Image' width="50px" height="50px"></span>
        </div>
        <div class="sidebar-brand-text mx-3">BIO HERBAL</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Product</span></a>
      </li>

      <!-- Nav Item - Transaksi -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-shopping-basket"></i>
          <span>Transaksi</span></a>
      </li>

      <!-- Nav Item - Mapping -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-map-marker"></i>
          <span>Mapping</span></a>
      </li>

      <!-- Nav Item - Laporan -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-file"></i>
          <span>Laporan</span></a>
      </li>

      <!-- Nav Item - History -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-history"></i>
          <span>History</span></a>
      </li>


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
            <a href="cart.php">
                <img src="img/cart.png" alt="Logo" style="width:40px; margin-top:10px">
                <span class="badge badge-success"><?php
                $cart = unserialize(serialize($_SESSION['cart']));
                echo count($cart); 
                ?></span>
            </a>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  Hello, <?=$nama?>
                </span>
                <img class="img-profile rounded-circle" src="img/no-image.jpg">
              </a>

              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <a class="dropdown-item" href="registrasi.php">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Registrasi Petugas
                </a>
                <!-- <div class="dropdown-divider"></div> -->
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">List Order</h1>
          </div>

          <!-- Content Row Untuk Menu Dashboard -->

          <div class="row">

            <div class="col-md-12">
              <form method="POST">
              <table class="table">
                <thead>
                  <tr class="table-success">
                    <th>Option</th>
                  	<th>Id</th>
                  	<th>Name</th>
                  	<th>Price</th>
                  	<th>Quantity</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                     $cart = unserialize(serialize($_SESSION['cart']));
                   	 $s = 0;
                   	 $index = 0;
                   	for($i=0; $i<count($cart); $i++){
                   		$s += $cart[$i]->price * $cart[$i]->quantity;
                   ?>
                  <tr>
                    <td><a href="cart.php?index=<?php echo $index; ?>" onclick="return confirm('Are you sure?')" >Delete</a> </td>
                 		<td> <?php echo $cart[$i]->id; ?> </td>
                 		<td> <?php echo $cart[$i]->name; ?> </td>
                 		<td> <?php echo $cart[$i]->price; ?> </td>
                    <td>
                      <button type="button" id="sub" class="sub">-</button>
                      <input type="text" value="<?php echo $cart[$i]->quantity; ?>" name="quantity[]" />
                      <button type="button" id="add" class="add">+</button>
                    </td>
                    <td> <?php echo $cart[$i]->price * $cart[$i]->quantity; ?> </td>
                  </tr>
                  <?php
                	 	$index++;
                 	} ?>
                  <tr>
                 		<td colspan="5" style="text-align:right; font-weight:bold">Total
                         <input type="image" src="img/save.png" width="20" name="update" alt="Save Button">
                         <input type="hidden" name="update">
                 		</td>
                 		<td> <?php echo $s; ?> </td>
                 	</tr>
                </tbody>
              </table>
            </form>
            <a href="list_product.php">Continue Shopping</a>
             <?php
                if (count($cart) != 0 && $_SESSION['next']==1){ ?>
               | <a href="form_data.php">Next</a>
               <?php }?>
            </div>
          <!-- /. row -->
          <!-- Content Row -->

          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; BioHerbal 2020</span>
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

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script type="text/javascript">
  $('.add').click(function () {
    $(this).prev().val(+$(this).prev().val() + 1);
  });
  $('.sub').click(function () {
    if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
  });
  </script>
</body>
</html>
