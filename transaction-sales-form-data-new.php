<?php
    session_start();
    $thisPage = "Transaction-Sales"; 
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
                        <h1 class="h3 mb-0 text-gray-800">Form Pembeli Baru</h1>
                    </div>

                    <!-- Content Row Untuk Menu Dashboard -->
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Pembeli Baru</h6>
                        </div>

                        <div class="container">

                            <div class="row">

                                <div class="col-md-12">
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                                        <h3>
                                            <center>Pendaftaran Customer Baru</center>
                                        </h3>
                                        <!--Nama-->
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Nama</label>
                                            <input type="text" name="nama" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Nama">
                                        </div>
                                        <!--TTL-->
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Tanggal Lahir</label>
                                            <input type="date" name="ttl" class="form-control" id="exampleFormControlInput1">
                                        </div>
                                        <!--HP-->
                                        <div class="form-group">
                                            <label>No HP</label>
                                            <input type="tel" class="form-control" name="telepon" placeholder="xxxxxxxxxx" pattern="[0-9]{12}" maxlength="12" required />
                                            <label style="font-size:9px;padding-left:20px"> Eg : 0812222224 </label>
                                        </div>
                                        <!--Alamat-->
                                        <div class="form-group">
                                            <label for="exampleFormControlInput2">Alamat</label>
                                            <input type="text" name="alamat" class="form-control" id="exampleFormControlInput2" placeholder="Masukkan Alamat">
                                        </div>
                                        <!--Dukuh-->
                                        <div class="form-group">
                                            <label for="exampleFormControlInput3">Dukuh</label>
                                            <input type="text" name="dukuh" class="form-control" id="exampleFormControlInput3" placeholder="Masukan Dukuh">
                                        </div>
                                        <!--RT/RW-->
                                        <div class="form-group">
                                            <label for="exampleFormControlInput4">RT/RW</label>
                                            <input type="text" name="rtrw" class="form-control" id="exampleFormControlInput4" placeholder="Masukkan RT/RW">
                                        </div>
                                        <!--Kelurahan-->
                                        <div class="form-group">
                                            <label>Kelurahan</label>
                                            <select placeholder="Pilih Kelurahan" data-allow-clear="1" name="kel" class="form-control">
                                                <option></option>
                                                <?php
                                            $sql = "SELECT p.PropinsiID, Propinsi, kot.KotaID, Kota, kec.KecID, Kecamatan, kel.KelID, Kelurahan FROM daftarpropinsi p JOIN daftarkota kot ON(p.PropinsiID=kot.PropinsiID) JOIN daftarkecamatan kec ON(kot.KotaID=kec.KotaID) JOIN daftar_kelurahan kel ON(kec.KecID=kel.KecID)";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                // output data of each row
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    $kid = $row["KelID"];
                                                    echo "<option value='$kid'>" . $row["Kelurahan"] . " - " . $row["Kecamatan"] . " - " . $row["Kota"] .  " - " . $row["Kelurahan"] . "</option>";
                                                }
                                            }
                                            ?>

                                            </select>
                                        </div>
                                        <!--Gender-->
                                        <div class="form-group">
                                            <label for="exampleFormControlInput2">Jenis Kelamin</label>
                                            <select name="gender" class="form-control">
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>

                                        <label for="infomarket">Info Market</label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="infomarket" value="Radio">Radio
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="infomarket" value="Internet">Internet
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="infomarket" value="Orang">Orang
                                            </label>
                                        </div>
                                        <!--Program Radio-->
                                        <div class="form-group">
                                            <label for="exampleFormControlInput7"><br>Info Program Radio</label>
                                            <input type="text" name="infoprogradio" class="form-control" id="exampleFormControlInput7" placeholder="Masukkan Informasi Program Radio">
                                            <label style="font-size:9px;padding-left:20px"> Eg : Berita, Music, Karaoke dll </label>
                                        </div>
                                        <!--Keterangan-->
                                        <!--<div class="form-group">
                                    <label for="exampleFormControlInput8">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" id="exampleFormControlInput8" placeholder="Masukkan Keterangan">
                                </div> -->

                                        <div align="right">
                                            <br>
                                            <button type="submit" class="btn btn-success" value="submit" name="submit">Simpan</button>
                                            <br><br><br>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /. row -->
                        <!-- Content Row -->

                    </div>

                </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </div>
    
    <div id="php">
        <?php
            if (isset($_POST['submit'])){
                $name = $_POST["nama"];
                $hp = $_POST["telepon"];
                $add = $_POST["alamat"];
                $dukuh = $_POST["dukuh"];
                $rt = $_POST["rtrw"];
                $kel = $_POST["kel"];
                $gen = $_POST["gender"];
                $ttl = $_POST["ttl"];
                $mar = $_POST["infomarket"];
                $rad = $_POST["infoprogradio"];
                //$ket = $_POST["keterangan"];
                //$stat = $_POST["status_anggota"];

                $cus = "INSERT INTO customers (Name, No_HP, Address, Dukuh, RTRW, KelID, Gender, Tgl_Lahir, InfoMarket, InfoProgRadio,  Status_Anggota)
                                    VALUES ('$name', '$hp', '$add', '$dukuh', '$rt', '$kel', '$gen', '$ttl', '$mar', '$rad',  '1')";

                if (mysqli_query($conn, $cus)) {
                    echo "New record created successfully";
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=cek-transaction-sales-form-data-new.php">';
                    exit;
                } else {
                    echo "Error: " . $cys . "<br>" . mysqli_error($conn) . "<br><br>";
                    echo "<p style='color:red'><center>ID Kelurahan = $kel</center></p>";
                }
                
            }
            ?>
    </div>

    <?php include 'modal.php'; ?>


</body>

</html>
