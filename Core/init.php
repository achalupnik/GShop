<?php
$host = "localhost";
$user = "root";
$password = "";
$db_name = "gshop";

$connection = @mysqli_connect($host, $user, $password, $db_name);
if($connection->errno){
    echo "Error: We are sorry, but you can/'t connect to data base. ".$connection->errno;
    die();
}
mysqli_set_charset($connection,"utf8");


























require_once 'helpers.php';