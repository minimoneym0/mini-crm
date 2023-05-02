<?php

namespace app;
use controllers\auth\AuthContoller;
use controllers\pages\PageController;
use controllers\roles\RoleController;
use controllers\users\UsersController;
use controllers\home\HomeController;

class Router{
    // определяем маршруты через регулярки
    private $routes = [
        '/^\/'.APP_BASE_PATH.'\/?$/' => ['controller'=>'home\\HomeController', 'action'=>'index'],
        '/^\/'.APP_BASE_PATH.'\/users(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller'=>'users\\UsersController'], // для users

    ];


    // пишем метод, запускающий сам роутер
    public function run(){
        $uri = $_SERVER['REQUEST_URI'];
        $controller = null;
        $action = null;
        $params = null;
        // пробегаем по маршрутам(routers), пока не найдем нужный
        foreach($this->routes as $pattern => $route){
            // ищем маршрут соответ-ий URI при помощи регулярки
            if(preg_match($pattern,$uri,$matches)){
                $controller = "controllers\\".$route['controller']; // получаем имя контроллера с маршрута($route)
                $action = $route['action'] ?? $matches['action'] ?? 'index'; // получаем действие из маршрута если оно есть, иначе из URI
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY); // получаем параметры из совпавших с регуляркой подстрок
                break; // прервем цикл, если нашли нужный маршрут
            }
        }
        if(!$controller){
            http_response_code(404);
            echo "Page not found";
            return;
        }
        
        $controllerInstance = new $controller();
        if(!method_exists($controllerInstance, $action)){
            http_response_code(404);
            echo "Page not found";
            return;
        }
        call_user_func_array([$controllerInstance, $action], [$params]);

    }
}