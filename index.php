<?php
// вывод всех ошибок на время отладки
error_reporting(E_ALL); 
ini_set('display_errors', 1);

// подключаем работу с бд
require_once 'app/models/Database.php';