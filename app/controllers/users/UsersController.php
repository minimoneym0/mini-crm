<?php

require_once 'app/models/roles/Role.php';
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
        if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])){
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            // если пароли не сопадают
            if($password !== $confirm_password){
                echo "Password does not match";
                return;
            }
            // если ошибок нет, вызываем модель User
            $userModel = new User();
            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => 1, // роль по умолчанию
            ];
            $userModel->create($data); // передаем в ф-ю глоб массив с данными из формы
        }
        header("Location: ?page=users");
    }
// создадим метод для удаления пользователей
    public function delete(){
        $userModel = new User();
        $userModel->delete($_GET['id']); // вызываем метод для удаления по id

        header('Location: ?page=users'); // после удаления перенаправляем на страницу с пользователями
    }

    public function edit(){
        $userModel = new User();
        $user = $userModel->read($_GET['id']); // получаем пользователя
// для получения ролей пользователя допишем
        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();
        
        include 'app/views/users/edit.php';
    }

    public function update(){
        $userModel = new User();
        $userModel->update($_GET['id'], $_POST);

        header('Location: ?page=users'); 
    }

}