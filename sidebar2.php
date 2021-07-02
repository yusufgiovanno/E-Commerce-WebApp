<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
    <?php
    include "session2.php";?>
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon">
            <!-- <i class="fas fa-laugh-wink"></i> -->
            <span class="logo-lg"><img src='img/LogoNew.png' alt='User Image' width="120px" height="60px"></span>
        </div>
        <div class="sidebar-brand-text mx-3"></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li <?php if($thisPage == "dashboard"){ echo "class='nav-item active'";}else{ echo "class='nav-item'";} ?> >
        <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>
    
    <!-- Nav Item - Transaction -->
    <li <?php if(substr($thisPage,0,4) == "Transaction"){ echo "class='nav-item active'";}else{ echo "class='nav-item'";} ?>>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-fw fa-shopping-basket"></i>
            <span>Transaction</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Fitur Map:</h6>
                <a <?php if($thisPage == "Transaction-Sales") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="transaction-sales.php">Sales</a>
                <?php if($lv>2){?>
                        <a <?php if($thisPage == "Transaction-Setoran") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="transaction-setoran.php">Setoran</a>
                <?php }
                ?>
                <?php if($lv<=3){?>
                <a <?php if($thisPage == "Transaction-Consinyasi") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="transaction-consinyasi.php">Consignment</a>
                <a <?php if($thisPage == "Transaction-Retur-Consinyasi") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="transaction-retur-consinyasi.php">Return Consignment</a>
                <?php
                }?>
            </div>
        </div>
    </li>
    
    <!-- Nav Item - Distribution Product -->
    <li <?php if(substr($thisPage,0,10) == "distribusi"){ echo "class='nav-item active'";}else{ echo "class='nav-item'";} ?>>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-industry"></i>
            <span>Distribution Product</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Fitur Transaksi:</h6>
                <?php  if($lv == 3){ ?>
                <a <?php if($thisPage == "distribusi-request") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="distribusi-request.php">Request to Order Product</a>
                <?php } ?>
                <?php  if($lv <= 2){ ?>
                <a <?php if($thisPage == "distribusi-order") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="distribusi-order.php">Order Product</a>
                <?php } ?>
                <a <?php if($thisPage == "distribusi-delivery") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="distribusi-delivery.php">Delivery Product</a>
                <a <?php if($thisPage == "distribusi-receive") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="distribusi-receive.php">Receive Product</a>
            </div>
        </div>
    </li>
    
    <?php if($lv<=3){?>
    <!-- Nav Item - ARUS KAS -->
    <li <?php if(substr($thisPage,0,4) == "cash"){ echo "class='nav-item active'";}else{ echo "class='nav-item'";} ?>>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-paw"></i>
            <span>Cash Flow</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Fitur Arus Kas:</h6>
                <a <?php if($thisPage == "cash-out") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="cash-out.php">cash Out</a>
                <a <?php if($thisPage == "cash-in") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="cash-in.php">cash In</a>
            </div>
        </div>
    </li>
    
    
    <!-- Nav Item - Mapping -->
    <li <?php if(substr($thisPage,0,4) == "maps"){ echo "class='nav-item active'";}else{ echo "class='nav-item'";} ?>>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-map-marker"></i>
            <span>Mapping</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Fitur Map:</h6>
                <a <?php if($thisPage == "maps_propinsi") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="maps-propinsi.php">Propinsi</a>
                <a <?php if($thisPage == "maps-kota")     { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="maps-kota.php">Kota</a>
                <a <?php if($thisPage == "maps-kecamatan"){ echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="maps-kecamatan.php">Kecamatan</a>
                <a <?php if($thisPage == "maps-kelurahan"){ echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="maps-kelurahan.php">Kelurahan</a>
            </div>
        </div>
    </li>
    <?php
    }?>

    <!-- Nav Item - Report -->
    <li <?php if(substr($thisPage,0,7) == "laporan"){ echo "class='nav-item active'";}else{ echo "class='nav-item'";} ?>>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-file"></i>
            <span>Report</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Fitur Transaksi:</h6>
                <a <?php if($thisPage == "laporan-transaksi") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="laporan-transaksi.php">Product Report</a>
                <a <?php if($thisPage == "laporan-pegawai") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="laporan-pegawai.php">Employee Report</a>
                <a <?php if($thisPage == "laporan-Info-Market") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="laporan-Info-Market.php">Market Report</a>
                <a <?php if($thisPage == "laporan-labarugi") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="laporan-labarugi.php">Laba/Rugi</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - History -->
    <li <?php if(substr($thisPage,0,7) == "history"){ echo "class='nav-item active'";}else{ echo "class='nav-item'";} ?>>
        <a class="nav-link" href="history.php">
            <i class="fas fa-fw fa-history"></i>
            <span>History</span></a>
    </li>
    <?php if($lv <= 2){ ?>
    <!-- Nav Item - User -->
    <li <?php if($thisPage == "user-activity"){ echo "class='nav-item active'";}else{ echo "class='nav-item'";} ?>>
        <a class="nav-link " href="user-status.php">
            <i class="fas fa-fw fa-users"></i>
            <span>User Activity</span>
        </a>
    </li>
    <?php } ?>

    <!-- Nav Item - Master -->
    <li <?php if(substr($thisPage,0,6) == "master"){ echo "class='nav-item active'";}else{ echo "class='nav-item'";} ?>>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-user"></i>
            <span>Master</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Fitur Master:</h6>
                <?php if($lv <= 2){ ?>
                <a <?php if($thisPage == "master-products") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="master-produk.php">Product</a>
                <a <?php if($thisPage == "master-pegawai") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="master-pegawai.php">Employee/User</a>
                <?php } if ($lv <= 3){?>
                <a <?php if($thisPage == "master-stock-awal") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="master-stock-awal.php">Stock Awal</a>
                
                <?php
                }?>
                <a <?php if($thisPage == "master-stock") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="master-stock.php">Stock</a> 
                <a <?php if($thisPage == "master-propinsi") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="master-propinsi.php">Propinsi</a>
                <a <?php if($thisPage == "master-kota") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="master-kota.php">Kota</a>
                <a <?php if($thisPage == "master-kecamatan") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="master-kecamatan.php">Kecamatan</a>
                <a <?php if($thisPage == "master-kelurahan") { echo "class='collapse-item active'";}else{ echo "class='collapse-item'";} ?> href="master-kelurahan.php">Kelurahan</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
