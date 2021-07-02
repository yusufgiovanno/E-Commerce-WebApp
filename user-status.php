<?php
session_start();
$thisPage = "user-activity"; 
?>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php
        include 'head.php';
        ?>
</head>

<body id="page-top">

    <?php include 'session.php'; ?>

    <div id="wrapper">

        <?php include 'sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'topbar.php'; ?>
                <div class="container-fluid">

                    <!-- Letak Konten -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Activity Pegawai</h1>
                    </div>

                    <!-- Content Row Untuk Menu History Details -->

                    <!-- DataTales Example -->
                    <div id="load-history">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Activity Pegawai</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID Pegawai</th>
                                                <th>Username</th>
                                                <th>Nama</th>
                                                <th>Status</th>
                                                <th>Tgl Aktif</th>
                                                <!--<th>Action</th>-->
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID Pegawai</th>
                                                <th>Username</th>
                                                <th>Nama</th>
                                                <th>Akses Akun</th>
                                                <th>Tgl Aktif</th>
                                                <!--<th>Action</th>-->
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php

                                        // $dataHistory = mysql_query("SELECT * FROM history ORDER BY id_lampu");
                                        $dataPegawai = mysqli_query($conn, "SELECT * FROM employees WHERE Notes='Confirm' ORDER BY login DESC");

                                        while($pegawai = mysqli_fetch_array($dataPegawai)){
                                            $id_pegawai = $pegawai['EmployeeID'];
                                            $user = $pegawai['Username'];
                                            $nama = $pegawai['TitleOfCourtesy']. '. ' .$pegawai['FirstName']. ' ' .$pegawai['LastName'];
                                            $status = $pegawai['login'];
                                            if ($status == "1") {
                                                $akses = "Active";
                                            } else $akses = "Sleep";
                                            $Tgl_Aktif=$pegawai['LoginDate'];

                                        ?>
                                            <tr>
                                                <td><?php echo $id_pegawai; ?></td>
                                                <td><?php echo $user; ?></td>
                                                <td><?php echo $nama; ?></td>
                                                <td><?php if ($akses=='Active'){?> <span class="logo-lg"><img src='img/smile.png' alt='User Activity' width="30px" height="30px" title="<?php echo $akses;?>"></span> <?php }else{?> <span class="logo-lg"><img src='img/sleeping.png' alt='User Activity' width="30px" height="30px" title="<?php echo $akses;?>"></span> <?php }; ?></td>
                                                <td><?php echo $Tgl_Aktif; ?></td>
                                                <!--<?php if ($status = "1") { ?>
<td class="tools" align="center"><a href="update-pegawai.php?id_pegawai=<?php echo $id_pegawai;?>&username=<?php echo $username;?>" title="Klik untuk Update data pegawai" class="btn btn-success">
<span class="fa fa-eye-slash"></span></a></td>
<?php } else { ?>
<td class="tools" align="center"><a href="update-pegawai.php?id_pegawai=<?php echo $id_pegawai;?>&username=<?php echo $username;?>" title="Klik untuk Update data pegawai" class="btn btn-success">
<span class="fa fa-eye"></span></a></td>
<?php 
             }
?>-->
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
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </div>
    <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  
    <?php include 'modal.php'; ?>




</body>

</html>
