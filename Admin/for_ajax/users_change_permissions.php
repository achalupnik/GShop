<?php
require_once '../../Core/init.php';

$id = (int)sanitize($_POST['id']);
$val = sanitize($_POST['val']);

$sql = "UPDATE users SET permissions='$val' WHERE id=".$id;
mysqli_query($connection, $sql);
