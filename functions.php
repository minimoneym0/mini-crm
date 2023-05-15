<?php
// вывод без прерывания скрипта
function pre($str){
    echo "<pre>";
        print_r($str);
    echo "<pre>";
}
// вывод с прерыванием работы скрипта
function preExit($str){
    echo "<pre>";
        print_r($str);
    echo "<pre>";
    exit;
}

function is_active($path){
    $currentPath = $_SERVER['REQUEST_URI']; // получает текущий урл
    return $path === $currentPath ? 'active' :''; 
}
