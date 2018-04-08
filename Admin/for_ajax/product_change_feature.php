<?php
require_once '../../Core/init.php';

$id = (int)sanitize($_POST['id']);
$sql = "SELECT * FROM product WHERE id=".$id;
$result = mysqli_query($connection, $sql);
$row = $result->fetch_assoc();
$feature = $row['feature'];
$feature = 1 - $feature;

$sql = "UPDATE product SET feature='$feature' WHERE id=".$id;
mysqli_query($connection, $sql);



