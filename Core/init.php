<?php

$host = "localhost";
$user = "root";
$password = "";
$db_name = "gshop";
/*
$host = "pma.ct8.pl";
$user = "m6145_tajniak";
$password = "Topsecret111";
$db_name = "m6145_gshop";*/

$connection = @mysqli_connect($host, $user, $password, $db_name);
if($connection->errno){
    echo "Error: We are sorry, but you can/'t connect to data base. ".$connection->errno;
    die();
}
mysqli_set_charset($connection,"utf8");

session_start();



if(isset($_SESSION['user_id']) && $_SESSION['user_id']>0){
    $sql = "SELECT * FROM users WHERE id=".$_SESSION['user_id'];
    $result = mysqli_query($connection, $sql);
    $user_data = $result->fetch_assoc();
}







require_once 'helpers.php';





















