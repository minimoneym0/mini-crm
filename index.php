<?php
use models\Check;
// вывод всех ошибок на время отладки
error_reporting(E_ALL); 
ini_set('display_errors', 1);

// подключаем конфиг и автозагрузчик
require_once 'config.php';
require_once 'autoload.php';
require_once 'functions.php';


$router = new app\Router(); // созд экземлп класса router
$router -> run(); // вызываем его метод run