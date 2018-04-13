<?php

function sanitize($dirty){
    return htmlentities($dirty, ENT_QUOTES, "UTF-8");
}

function display_errors($errors){
    $temp = '<ul class="bg-danger">';
    foreach($errors as $item){
        $temp .= '<li class="text-warning">'.$item.'</li>';
    }
    $temp .= '</ul>';
    return $temp;
}

function is_logged(){
    return (isset($_SESSION['user_id']) && $_SESSION['user_id']>0);
}

function have_permission($permission = 'admin'){
    global $user_data;
    $array = explode(',', $user_data['permissions']);
    return in_array($permission, $array);
}