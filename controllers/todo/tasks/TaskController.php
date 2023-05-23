<?php
namespace controllers\todo\tasks;
use models\todo\tasks\TaskModel;
use models\todo\tasks\TagsModel;
use models\todo\category\CategoryModel;
use models\Check;

// контроллеры обрабатывают данные и передают в модель
class TaskController{
    private $check;
    private $tagsModel;

    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $this->check = new Check($userRole);
        $this->tagsModel = new TagsModel();
    }
    // метод отображающий всех пользователей
    public function index(){
        $this->check->requirePermission();
        $taskModel = new TaskModel(); // создаем экземпляр класса Role(находится в моделях)
        $tasks = $taskModel->getAllTasks(); // получаем роли из модели

        include 'app/views/todo/tasks/index.php'; // подключаем файл, который будет html шаблоном для списка пользователей
    }
    // пишем метод, который вызывает шаблон страницы
    public function create(){
        $this->check->requirePermission();

        $todoCategory = new CategoryModel(); // создаем экземпляр класса
        $categories = $todoCategory->getAllCategoriesWithUsability(); // получаем из модели

        include 'app/views/todo/tasks/create.php';
    }

    public function store(){
        if(isset($_POST['title']) && isset($_POST['category_id']) && isset($_POST['finish_date'])){
            
            $data['title'] = trim($_POST['title']);
            $data['category_id'] = trim($_POST['category_id']);
            $data['finish_date'] = trim($_POST['finish_date']);
            $data['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0 ;
            $data['status'] = 'new';
            $data['priority'] = 'low';

            $taskModel = new TaskModel();
            $taskModel->createTask($data);
        }
        $path = '/'. APP_BASE_PATH . '/todo/tasks';
        header("Location: $path");
    }

    public function edit($params){
        $this->check->requirePermission();
        
        $taskModel = new TaskModel();
        $task = $taskModel->getTaskById($params['id']);

        $todoCategoryModel = new CategoryModel();
        $categories = $todoCategoryModel->getAllCategoriesWithUsability();

        if(!$task){
            echo "Task not found";
            return;
        } 

        $tags = $this->tagsModel -> getTagsByTaskId($task['id']);

        include 'app/views/todo/tasks/edit.php';
    }

    public function update(){
        $this->check->requirePermission();

        if(isset($_POST['title']) && isset($_POST['category_id']) && isset($_POST['finish_date'])){
            
            $data['id']  = $_POST['id'];
            $data['title'] = trim($_POST['title']);
            $data['category_id'] = trim($_POST['category_id']);
            $data['finish_date'] = trim($_POST['finish_date']);
            $data['reminder_at'] = trim($_POST['reminder_at']);
            $data['status'] = trim($_POST['status']);
            $data['priority'] = trim($_POST['priority']);
            $data['description'] = trim($_POST['description']);

            $data['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0 ;
            

            // обработка даты окончания и напоминания
            $finish_date_value = $data['finish_date'];
            $reminder_at_option = $data['reminder_at'];
            $finish_date = new \DateTime($finish_date_value);

            switch($reminder_at_option){
                case '30_minutes':
                    $interval = new \DateInterval('PT30M'); // переводим в понятные значения даты и времени
                    break;
                case '1_hour':
                    $interval = new \DateInterval('PT1H'); // переводим в понятные значения даты и времени
                    break;
                case '2_hour':
                    $interval = new \DateInterval('PT2H'); // переводим в понятные значения даты и времени
                    break;
                case '12_hours':
                    $interval = new \DateInterval('PT12H'); // переводим в понятные значения даты и времени
                    break;
                case '24_hours':
                    $interval = new \DateInterval('PT1D'); // переводим в понятные значения даты и времени
                    break;
                case '7_days':
                    $interval = new \DateInterval('PT7D'); // переводим в понятные значения даты и времени
                    break;
            }

            $reminder_at = $finish_date->sub($interval);
            $data['reminder_at'] = $reminder_at->format('Y-m-d\TH:i');

            // обновляем данные по задаче в базе
            $taskModel = new TaskModel();
            $taskModel->updateTask($data);

            // обработка тегов
            $tags = explode(',', $_POST['tags']);
            $tags = array_map('trim', $tags);

            // получение тегов с базы по задаче, которую редактируем
            $oldTags = $this->tagsModel->getTagsByTaskId($data['id']);

            // удаление старых связей между тегами и задачей
            $this->tagsModel->removeAllTaskTags($data['id']);

            // добавляем новые теги и связываем с задачей
            foreach($tags as $tag_name){
                $tag = $this->tagsModel->getTagByNameAndUserId($tag_name, $data['user_id']);
            }
        }
        $path = '/'. APP_BASE_PATH . '/todo/tasks';
        header("Location: $path");
    }

    // создадим метод для удаления ролей
    public function delete($params){
        $this->check->requirePermission();
        $todoCategoryModel = new TaskModel();
        $todoCategoryModel->deleteTask($params['id']); // вызываем метод для удаления по id

        $path = '/'. APP_BASE_PATH . '/todo/tasks';
        header("Location: $path"); // после удаления перенаправляем на страницу с пользователями
    }

}