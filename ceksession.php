<?php
session_start();
print_r($_SESSION);
echo '<br>';
  class Item{
     var $id;
     var $name;
     var $price;
     var $quantity;
    }
    
$cart = unserialize(serialize($_SESSION['cart']));
for($i = 0; $i<10; $i++){
    echo $cart[$i]->id;
    echo '<br>';
}
?>