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