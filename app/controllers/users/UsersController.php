<?php
// контроллеры обрабатывают данные и передают в модель
class UsersController{
    // метод отображающий всех пользователей
    public function index(){
        $userModel = new User(); // создаем экземпляр' класса User(находится в моделях)
        $users = $userModel->readAll(); // получаем пользователей из модели User

        include 'app/views/users/index.php'; // подключаем файл, который будет html шаблоном для списка пользователей
    }
    // пишем метод, который вызывает шаблон страницы
    public function create(){
        include 'app/views/users/create.php';
    }

    public function store(){
        if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['is_admin'])){
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            // если пароли не сопадают
            if($password !== $confirm_password){
                echo "Password does not match";
                return;
            }
            // если ошибок нет, вызываем модель User
            $userModel = new User();
            $userModel->create($_POST); // передаем в ф-ю глоб массив с данными из формы
        }
        header("Location: ?page=users");
    }

}