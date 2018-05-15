<?php
require_once '../Core/init.php';

ob_start();

if(!is_logged()){
    echo 3;
    exit();
}

//Check if all inputs are filled
$error = 0;
if(isset($_POST['product_id']) && !empty($_POST['product_id']))
    $id = (int)sanitize($_POST['product_id']);
else
    $error = 1;

if(isset($_POST['cart_size']) && !empty($_POST['cart_size']))
    $size = (int)sanitize($_POST['cart_size']);
else
    $error = 1;

if(isset($_POST['cart_quantity']) && !empty($_POST['cart_quantity']))
    $quantity_ordered = (int)sanitize(($_POST['cart_quantity']));
else
    $error = 1;

if($error == 1){
    echo $error;
    exit();
}

if($size<1 || $quantity_ordered<1)
    exit();


//Check if ordered amount of commodity is available
$sql = "SELECT * FROM product WHERE id=".$id;
$result = mysqli_query($connection, $sql);
$row = $result->fetch_assoc();
$options = explode(',',$row['size']);
$sizes = array();
$quantities = array();
foreach($options as $item){
    $temp = explode(':', $item);
    $sizes[] .= $temp[0];
    $quantities[] .= $temp[1];
}

$quantity = $quantities[$size-1];
$size = $sizes[$size-1];

if($quantity<$quantity_ordered){
    echo 2;
    exit();
}



//Insert to db
$expire_date = date('Y:m:d H:i:s', strtotime("+30 days"));
$sql = "INSERT INTO cart (items,expire_date) VALUES ('$items','$expire_date')";


echo ob_get_clean();
