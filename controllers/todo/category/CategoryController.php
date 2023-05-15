<?php
namespace controllers\todo\category;
use models\todo\category\CategoryModel;
use models\Check;

// контроллеры обрабатывают данные и передают в модель
class CategoryController{
    private $check;
    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $this->check = new Check($userRole);
    }
    // метод отображающий всех пользователей
    public function index(){
        $this->check->requirePermission();
        $todoCategory = new CategoryModel(); // создаем экземпляр класса Role(находится в моделях)
        $categories = $todoCategory->getAllCategories(); // получаем роли из модели

        include 'app/views/todo/category/index.php'; // подключаем файл, который будет html шаблоном для списка пользователей
    }
    // пишем метод, который вызывает шаблон страницы
    public function create(){
        $this->check->requirePermission();
        include 'app/views/todo/category/create.php';
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
        $this->check->requirePermission();
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