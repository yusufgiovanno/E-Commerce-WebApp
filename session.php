<?php
include "dist/db.php";
if (!isset($_SESSION['username'])) {
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
                    Menu Login
                    </a> 

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
            ");
}

$username = $_SESSION['username'];
$tampilNama=mysqli_query($conn, "SELECT * FROM employees WHERE Username='$username'");
$hasil=mysqli_fetch_array($tampilNama);
$nama = $hasil['FirstName'] . ' ' . $hasil['LastName'];
$lv= $hasil['Level'];
$eid = $hasil['EmployeeID'];
$_SESSION['eid'] = $eid;
$tanggal = $_GET['tanggal'];
$id = $_GET['id'];
?>
