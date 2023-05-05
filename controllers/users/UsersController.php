<?php
namespace controllers\users;
use models\roles\Role;
use models\users\User;
use models\Check;

// контроллеры обрабатывают данные и передают в модель
class UsersController{
    private $check;
    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $this->check = new Check($userRole);
    }
    // метод отображающий всех пользователей
    public function index(){
        $userModel = new User(); // создаем экземпляр' класса User(находится в моделях)
        $users = $userModel->readAll(); // получаем пользователей из модели User

        include 'app/views/users/index.php'; // подключаем файл, который будет html шаблоном для списка пользователей
    }
    // пишем метод, который вызывает шаблон страницы
    public function create(){
        include 'app/views/users/create.php';
    }

    public function store(){
        if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])){
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            // если пароли не сопадают
            if($password !== $confirm_password){
                echo "Password does not match";
                return;
            }
            // если ошибок нет, вызываем модель User
            $userModel = new User();
            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => 1, // роль по умолчанию
            ];
            $userModel->create($data); // передаем в ф-ю глоб массив с данными из формы
        }
        $path = '/'.APP_BASE_PATH.'/users';
        header("Location: $path");
    }
// создадим метод для удаления пользователей
    public function delete($params){
        $userModel = new User();
        $userModel->delete($params['id']); // вызываем метод для удаления по id

        $path = '/'.APP_BASE_PATH.'/users';
        header("Location: $path");  // после удаления перенаправляем на страницу с пользователями
    }

    public function edit($params){
        $userModel = new User();
        $user = $userModel->read($params['id']); // получаем пользователя
// для получения ролей пользователя допишем
        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();
        
        include 'app/views/users/edit.php';
    }

    public function update($params){
        $userModel = new User();
        $userModel->update($params['id'], $_POST);

        $path = '/'.APP_BASE_PATH.'/users';
        header("Location: $path"); 
    }

}