<?php
require_once '../../Core/init.php';

if(!is_logged()){
    header('Location: login.php');
    $_SESSION['error_flash'] = "Musisz być zalogowany by mieć dostęp do tej funkcji";
    exit();
}

if(!have_permission('editor')){
    header('Location: index.php');
    $_SESSION['error_flash'] = "Nie masz potrzebnych uprawnień by przeprowadzić tą akcję";
    exit();
}

$id = (int)sanitize($_POST['id']);
$sql = "SELECT * FROM product WHERE id=".$id;
$result = mysqli_query($connection, $sql);
$row = $result->fetch_assoc();
$feature = $row['feature'];
$feature = 1 - $feature;

$sql = "UPDATE product SET feature='$feature' WHERE id=".$id;
mysqli_query($connection, $sql);



