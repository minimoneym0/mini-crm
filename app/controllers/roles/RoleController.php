<?php
require_once 'app/models/roles/Role.php';

// контроллеры обрабатывают данные и передают в модель
class RoleController{
    // метод отображающий всех пользователей
    public function index(){
        $roleModel = new Role(); // создаем экземпляр класса Role(находится в моделях)
        $roles = $roleModel->getAllRoles(); // получаем роли из модели

        include 'app/views/roles/index.php'; // подключаем файл, который будет html шаблоном для списка пользователей
    }
    // пишем метод, который вызывает шаблон страницы
    public function create(){
        include 'app/views/users/create.php';
    }

    public function store(){
        if(isset($_POST['role_name']) && isset($_POST['role_description'])){
            $role_name = trim($_POST['role_name']);
            $role_description = trim($_POST['role_description']);

            if(empty($role_name)){
                echo "Role name is required!";
                return;
            }

            $roleModel = new Role();
            $roleModel->createRole($role_name, $role_description);
        }
        header("Location: index.php?page=roles");
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
        
        include 'app/views/users/edit.php';
    }

    public function update(){
        $userModel = new User();
        $userModel->update($_GET['id'], $_POST);

        header('Location: ?page=users'); 
    }

}