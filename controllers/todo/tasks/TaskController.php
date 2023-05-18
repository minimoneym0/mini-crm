<?php
namespace controllers\todo\tasks;
use models\todo\tasks\TaskModel;
use models\todo\category\CategoryModel;
use models\Check;

// контроллеры обрабатывают данные и передают в модель
class TaskController{
    private $check;
    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $this->check = new Check($userRole);
    }
    // метод отображающий всех пользователей
    public function index(){
        //$this->check->requirePermission();
        $taskModel = new TaskModel(); // создаем экземпляр класса Role(находится в моделях)
        $tasks = $taskModel->getAllTasks(); // получаем роли из модели

        include 'app/views/todo/tasks/index.php'; // подключаем файл, который будет html шаблоном для списка пользователей
    }
    // пишем метод, который вызывает шаблон страницы
    public function create(){
        $this->check->requirePermission();

        $todoCategory = new CategoryModel(); // создаем экземпляр класса
        $categories = $todoCategory->getAllCategories(); // получаем из модели

        include 'app/views/todo/tasks/create.php';
    }

    public function store(){
        if(isset($_POST['title']) && isset($_POST['description'])){
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

            if(empty($title) || empty($description)){
                echo "Title and Description is required!";
                return;
            }

            $todoCategoryModel = new TaskModel();
            $todoCategoryModel->createCategory($title, $description, $user_id);
        }
        $path = '/'. APP_BASE_PATH . '/todo/tasks';
        header("Location: $path");
    }

    public function edit($params){
        $this->check->requirePermission();
        $todoCategoryModel = new TaskModel();
        $category = $todoCategoryModel->getCategoryById($params['id']); // получаем роль

        if(!$category){
            echo "Category not found";
            return;
        } 
        include 'app/views/todo/tasks/edit.php';
    }

    public function update(){
        $this->check->requirePermission();
        if(isset($_POST['id']) && isset($_POST['title']) && isset($_POST['description'])){
            $id = trim($_POST['id']);
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $usability = isset($_POST['usability']) ? $_POST['usability'] : 0;

            if(empty($title) || empty($description)){
                echo "title and description is required";
                return;
            }

            $todoCategoryModel = new TaskModel();
            $todoCategoryModel->updateCategory($id, $title, $description, $usability);
        }
        $path = '/'. APP_BASE_PATH . '/todo/tasks';
        header("Location: $path");
    }

    // создадим метод для удаления ролей
    public function delete($params){
        $this->check->requirePermission();
        $todoCategoryModel = new TaskModel();
        $todoCategoryModel->deleteCategory($params['id']); // вызываем метод для удаления по id

        $path = '/'. APP_BASE_PATH . '/todo/tasks';
        header("Location: $path"); // после удаления перенаправляем на страницу с пользователями
    }

}