<?php
$id = $_GET['id'];
$idemp = $_GET['emp'];
include 'dist/db.php';
$sql = "SELECT SalePrice,UnitPrice,Level FROM products, employees WHERE ProductID='$id' and EmployeeID='$idemp'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)) {?>
    <!-- Sale Price -->
        <div class="row">
        <div class="col-25">
        <label>Harga Jual <a style="color: red;">*</a></label>
        </div>
        <div class="col-75">
        <!--<input type="text" name="SalePrice" value="<?php  echo $row['SalePrice'];?>" class="form-control">-->
        <input type="number" name="SalePrice" value="<?php  echo $row['SalePrice'];?>" <?php  if ($row['Level']<=3){ ?> readonly="" <?php } ?> min="<?php echo $row['SalePrice'];?>"  class="form-control">
        <label style="color:red">*Harga Jual tidak boleh kurang dari harga awal.</label>
        </div>
        </div>

        <!-- Unit Price -->
        <div class="row">
        <div class="col-25">
        <label>Harga Barang<a style="color: red;">*</a></label>
        </div>
        <div class="col-75">
        <input type="number" name="UnitPrice" value="<?php  echo $row['UnitPrice'];?>" <?php  if ($row['Level']<=3){ ?> readonly="" <?php } ?>  min="<?php echo $row['UnitPrice'];?>" max="<?php echo $row['SalePrice'];?>" class="form-control">
        <label style="color:red">*Harga Barang tidak boleh kurang dari harga awal.</label>
        </div>
        </div>
<?php }
mysqli_close($conn);
?>