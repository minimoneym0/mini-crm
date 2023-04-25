<?php
require_once 'app/models/AuthUser.php';

// контроллеры обрабатывают данные и передают в модель
class AuthController{
    // метод показывает форму регистрации
    public function register(){
        include 'app/views/users/register.php';
    }


    public function store(){
        if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])){
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);

            if(empty($username) || empty($email) || empty($password) || empty($confirm_password)){
                echo "All fields are required";
                return;
            }
            // если пароли не сопадают
            if($password !== $confirm_password){
                echo "Password does not match";
                return;
            }
            // если ошибок нет, вызываем модель User
            $userModel = new AuthUser();
            $userModel->register($username, $email, $password);
        }
        header("Location: ?page=login"); // после регистрации, пользователя перенаправляется на страницу авторизации
    }

    public function login(){     
        include 'app/views/users/login.php';
    }

    // метод для аутентификации пользователя
    public function authenticate(){
      $authModel = new AuthUser();

      if(isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $remember = isset($_POST['remember']) ? $_POST['remember'] : '';

// проверяем есть ли email и пароль, записываем их в переменные и через метод поиска email сравниваем есть ли такой в системе
        $user = $authModel->findByEmail($email);
// если пользователь найден и проверен(успешная авторизация), стартуем сессию и пишем в нее id и роль пользователя
        if($user && password_verify($password, $user['password'])){
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
// если чекбокс отмечен записываем куки пользователя
            if($remember == 'on'){
                setcookie('user_email', $email, time() + (7 * 24 * 60 * 60), '/');
                setcookie('user_password', $password, time() + (7 * 24 * 60 * 60), '/');
            }

            header('Location: index.php');
        }else{
            echo "sory, bad data, try again";
        }
      }
    }

    // создадим метод для выхода пользователя из системы
    public function logout(){
        session_start();
        session_unset(); // удаляем все зарегестрированные переменные текущей сессии
        session_destroy(); // уничтожает все данные связанные с текущей сессией
        header('Location: index.php'); // после удаления перенаправляем на главную
    }

}