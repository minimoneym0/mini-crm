<?php
namespace controllers\home;

use models\todo\tasks\TaskModel;

class HomeController{

    public function index(){
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

        require_once 'app/views/index.php';
    }
}