<?php
require_once '../Core/init.php';
if(!is_logged()){
    header('Location: login.php');
    $_SESSION['error_flash'] = "Nie możesz skorzystać z tej funkcji nie będąc zalogowanym";
    exit();
}
session_destroy();
header('Location: login.php');
session_start();
$_SESSION['success_flash'] = 'Zostałeś wyglogowany';
