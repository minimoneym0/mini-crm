<?php
namespace controllers\home;

use models\todo\tasks\TaskModel;

class HomeController{

    public function index(){
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

        $taskModel = new TaskModel();
        $tasks = $taskModel->getAllTasksByIdUser($user_id); // получаем задачи

        $tasksJson = json_encode($tasks); // парсим задачи из нашего массива в json объект

        require_once 'app/views/index.php';
    }
}