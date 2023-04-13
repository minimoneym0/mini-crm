<?php
// вывод всех ошибок на время отладки
error_reporting(E_ALL); 
ini_set('display_errors', 1);

// подключаем работу с бд и модель User
require_once 'app/models/Database.php';
require_once 'app/models/User.php';
// подключаем контроллеры
require_once 'app/controllers/users/UsersController.php';
require_once 'app/controllers/users/AuthController.php';