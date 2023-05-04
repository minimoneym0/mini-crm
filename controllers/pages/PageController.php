<?php
namespace controllers\pages;
use models\pages\PageModel;

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
        if(isset($_POST['title']) && isset($_POST['slug']) && isset($_POST['role'])){
            $title = trim($_POST['title']);
            $slug = trim($_POST['slug']);
            $role = trim($_POST['role']);

            if(empty($title) || empty($slug) || empty($slug)) {
                echo "Title or slug or role fields are required!";
                return;
            }

            $pageModel = new PageModel();
            $pageModel->createPage($title, $slug, $role);
        }
        $path = '/'. APP_BASE_PATH . '/pages';
        header("Location: $path");
    }

    public function edit($params){
        $pageModel = new PageModel();
        $page = $pageModel->getPageById($params['id']); // получаем страницу

        if(!$page){
            echo "Role not found";
            return;
        }
        
        include 'app/views/pages/edit.php';
    }

    public function update(){
        if(isset($_POST['id']) && isset($_POST['title']) && isset($_POST['slug']) && isset($_POST['role'])){
            $id = $_POST['id'];
            $title = trim($_POST['title']);
            $slug = trim($_POST['slug']);
            $role = trim($_POST['role']);

            if(empty($title) || empty($slug) || empty($role)){
                echo "Title or slug is required";
                return;
            }

            $pageModel = new PageModel();
            $pageModel->updatePage($id, $title, $slug, $role);
        }
        $path = '/'. APP_BASE_PATH . '/pages';
        header("Location: $path");
    }

    // создадим метод для удаления пользователей
    public function delete($params){
        $pageModel = new PageModel();
        $pageModel->deletePage($params['id']); // вызываем метод для удаления по id

        $path = '/'. APP_BASE_PATH . '/pages';
        header("Location: $path"); // после удаления перенаправляем на страницу с пользователями
    }

}