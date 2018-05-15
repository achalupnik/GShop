<?php
require_once 'Core/init.php';

define('COOKIE_NAME', 'dasdSDOks89yas');
$cookie_expire = time() + 60*60*24*30;
$domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false;

if(isset($card_id) && !empty($card_id)){

}else{
    $card_id = $connection->insert_id;
    setcookie(COOKIE_NAME, $card_id , $cookie_expire, '/', $domain, false);
}

