<?php
namespace controllers\roles;
use models\roles\Role;

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
        $path = '/'. APP_BASE_PATH . '/roles';
        header("Location: $path");
    }

    public function edit($params){
        $roleModel = new Role();
        $role = $roleModel->getRoleById($params['id']); // получаем роль

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
        $path = '/'. APP_BASE_PATH . '/roles';
        header("Location: $path");
    }

    // создадим метод для удаления ролей
    public function delete($params){
        $roleModel = new Role();
        $roleModel->deleteRole($params['id']); // вызываем метод для удаления по id

        $path = '/'. APP_BASE_PATH . '/roles';
        header("Location: $path"); // после удаления перенаправляем на страницу с пользователями
    }

}