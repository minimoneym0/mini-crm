<?php
namespace controllers\pages;
use models\pages\PageModel;
use models\roles\Role;
use models\Check;

// контроллеры обрабатывают данные и передают в модель
class PageController{
    private $check;
    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $this->check = new Check($userRole);
    }
    
    // метод отображающий всех пользователей
    public function index(){
        $this->check->requirePermission();

        $pageModel = new PageModel(); // создаем экземпляр класса Role(находится в моделях)
        $pages = $pageModel->getAllPages(); // получаем роли из модели

        include 'app/views/pages/index.php'; // подключаем файл, который будет html шаблоном для списка пользователей
    }
    // пишем метод, который вызывает шаблон страницы
    public function create(){
        $this->check->requirePermission();
        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();
        include 'app/views/pages/create.php';
    }

    public function store(){
        $this->check->requirePermission();
        if(isset($_POST['title']) && isset($_POST['slug']) && isset($_POST['roles'])){
            $title = trim($_POST['title']);
            $slug = trim($_POST['slug']);
            $roles = implode(',', $_POST['roles']);

            if(empty($title) || empty($slug) || empty($roles)) {
                echo "Title or slug or role fields are required!";
                return;
            }

            $pageModel = new PageModel();
            $pageModel->createPage($title, $slug, $roles);
        }
        $path = '/'. APP_BASE_PATH . '/pages';
        header("Location: $path");
    }

    public function edit($params){
        $this->check->requirePermission();
        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();

        $pageModel = new PageModel();
        $page = $pageModel->getPageById($params['id']); // получаем страницу

        if(!$page){
            echo "Role not found";
            return;
        }
        
        include 'app/views/pages/edit.php';
    }

    public function update(){
        $this->check->requirePermission();
        if(isset($_POST['id']) && isset($_POST['title']) && isset($_POST['slug']) && isset($_POST['roles'])){
            $id = $_POST['id'];
            $title = trim($_POST['title']);
            $slug = trim($_POST['slug']);
            $roles = implode(',', $_POST['roles']);

            if(empty($title) || empty($slug) || empty($roles)){
                echo "Title or slug is required";
                return;
            }

            $pageModel = new PageModel();
            $pageModel->updatePage($id, $title, $slug, $roles);
        }
        $path = '/'. APP_BASE_PATH . '/pages';
        header("Location: $path");
    }

    // создадим метод для удаления пользователей
    public function delete($params){
        $this->check->requirePermission();
        $pageModel = new PageModel();
        $pageModel->deletePage($params['id']); // вызываем метод для удаления по id

        $path = '/'. APP_BASE_PATH . '/pages';
        header("Location: $path"); // после удаления перенаправляем на страницу с пользователями
    }


}