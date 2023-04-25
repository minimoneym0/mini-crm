<?php
// вывод всех ошибок на время отладки
error_reporting(E_ALL); 
ini_set('display_errors', 1);

// подключаем работу с бд и модель User
require_once 'app/models/Database.php';
require_once 'app/models/User.php';
require_once 'app/models/AuthUser.php';

require_once 'app/models/roles/Role.php';
// подключаем контроллеры
require_once 'app/controllers/users/UsersController.php';
require_once 'app/controllers/users/AuthController.php';

require_once 'app/controllers/roles/RoleController.php';
// подкл контроллер домашней страницы
require_once 'app/controllers/HomeController.php';

require_once 'app/router.php';

$router = new Router(); // созд экземлп класса router
$router -> run(); // вызываем его метод run