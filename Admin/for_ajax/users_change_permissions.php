<?php
require_once '../../Core/init.php';
if(!is_logged()){
    header('Location: login.php');
    $_SESSION['error_flash'] = "Musisz być zalogowany by mieć dostęp do tej funkcji";
    exit();
}

if(!have_permission()){
    header('Location: index.php');
    $_SESSION['error_flash'] = "Nie masz potrzebnych uprawnień by przeprowadzić tą akcję";
    exit();
}

$id = (int)sanitize($_POST['id']);
$val = sanitize($_POST['val']);

if($id == $user_data['id'])
    exit();

$sql = "UPDATE users SET permissions='$val' WHERE id=".$id;
mysqli_query($connection, $sql);
