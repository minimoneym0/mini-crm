<?php

class Router{
    // пишем метод, запускающий сам роутер, инициализируется в корневом index.php
    public function run(){
        // если есть get параметр page, то мы его забираем, иначе считаем что у нас home в $page
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        // в зависимости от того, что пришло через get, вызываем нужный контроллер
        switch($page){
            case '': // подкл контроллер с выводом главн стр если строка без GET
            case 'home': 
                $controller = new HomeController();
                $controller -> index();
            break;
            case 'users':
                $controller = new UsersController(); // созд экземпл класса
                // напишем проверку на действие(action)
                if(isset($_GET['action'])){
                    switch($_GET['action']){
                        case 'create':
                            $controller -> create(); 
                            break;
                        case 'store':
                            $controller -> store(); // вызов метода для отработки action=store
                            break;
                        case 'delete':
                            $controller -> delete(); // вызов метода для отработки action=delete
                        break;
                    }
                }else{
                    $controller -> index(); // вызываем метод со списком пользователей
                }
                break;
            default: // по умолчанию, если страница не найдена(нет нужного GET параметра) выводим 404 и сообщение
                http_response_code(404);
                echo "Page not found";
                break;
        }
    }
}