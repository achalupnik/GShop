<?php
require_once '../../Core/init.php';

$id = (int)sanitize($_POST['id']);
$sql = "SELECT * FROM product WHERE id=".$id;
$result = mysqli_query($connection, $sql);
$row = $result->fetch_assoc();

unlink($_SERVER['DOCUMENT_ROOT'].$row['image']);
$sql = "UPDATE product SET image='' WHERE id=".$id;
mysqli_query($connection, $sql);