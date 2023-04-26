<?php
require_once 'app/models/pages/PageModel.php';

// контроллеры обрабатывают данные и передают в модель
class PageController{
    // метод отображающий всех пользователей
    public function index(){
        $pageModel = new PageModel(); // создаем экземпляр класса Role(находится в моделях)
        $pages = $pageModel->getAllPages(); // получаем роли из модели

        include 'app/views/pages/index.php'; // подключаем файл, который будет html шаблоном для списка пользователей
    }
    // пишем метод, который вызывает шаблон страницы
    public function create(){
        include 'app/views/pages/create.php';
    }

    public function store(){
        if(isset($_POST['title']) && isset($_POST['slug'])){
            $title = trim($_POST['title']);
            $slug = trim($_POST['slug']);

            if(empty($title) || empty($slug)){
                echo "Title or slug fields are required!";
                return;
            }

            $pageModel = new PageModel();
            $pageModel->createPage($title, $slug);
        }
        header("Location: index.php?page=pages");
    }

    public function edit($id){
        $pageModel = new PageModel();
        $page = $pageModel->getPageById($id); // получаем страницу

        if(!$page){
            echo "Role not found";
            return;
        }
        
        include 'app/views/pages/edit.php';
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