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
