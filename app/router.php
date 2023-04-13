<?php

class Router{
    // пишем метод, запускающий сам роутер, инициализируется в корневом index.php
    public function run(){
        // если есть get параметр page, то мы его забираем, иначе считаем что у нас home в $page
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        // в зависимости от того, что пришло через get, вызываем нужный контроллер
        switch($page){
            case 'users':
                $controller = new UsersController(); // созд экземпл класса
                $controller -> index(); // вызываем метод со списком пользователей
                break;
            default: // по умолчанию, если страница не найдена выводим 404 и сообщение
                http_response_code(404);
                echo "Page not found";
                break;
        }
    }
}