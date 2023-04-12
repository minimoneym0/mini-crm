<?php
// контроллеры обрабатывают данные и передают в модель
class UsersController{
    // метод отображающий всех пользователей
    public function index(){
        $userModel = new User(); // создаем экземпляр' класса User(находится в моделях)
        $users = $userModel->readAll(); // получаем пользователей из модели User

        include 'app/views/users/index.php'; // подключаем файл, который будет html шаблоном
    }
}