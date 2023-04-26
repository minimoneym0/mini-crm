<?php
require_once 'app/models/pages/PageModel.php';

// контроллеры обрабатывают данные и передают в модель
class PageController{
    // метод отображающий всех пользователей
    public function index(){
        $pageModel = new PageModel(); // создаем экземпляр класса Role(находится в моделях)
        $pages = $pageModel->getAllRoles(); // получаем роли из модели

        include 'app/views/roles/index.php'; // подключаем файл, который будет html шаблоном для списка пользователей
    }
    // пишем метод, который вызывает шаблон страницы
    public function create(){
        include 'app/views/roles/create.php';
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

    public function edit($id){
        $roleModel = new Role();
        $role = $roleModel->getRoleById($id); // получаем роль

        if(!$role){
            echo "Role not found";
            return;
        }
        
        include 'app/views/roles/edit.php';
    }

    public function update(){
        if(isset($_POST['id']) && isset($_POST['role_name']) && isset($_POST['role_description'])){
            $id = trim($_POST['id']);
            $role_name = trim($_POST['role_name']);
            $role_description = trim($_POST['role_description']);

            if(empty($role_name)){
                echo "Role name is required";
                return;
            }

            $roleModel = new Role();
            $roleModel->updateRole($id, $role_name, $role_description);
        }
        header("Location: index.php?page=roles");
    }

    // создадим метод для удаления пользователей
    public function delete(){
        $roleModel = new Role();
        $roleModel->deleteRole($_GET['id']); // вызываем метод для удаления по id

        header('Location: index.php?page=roles'); // после удаления перенаправляем на страницу с пользователями
    }

}