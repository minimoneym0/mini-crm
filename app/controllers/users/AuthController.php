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
// проверяем есть ли email и пароль, записываем их в переменные и через метод поиска email сравниваем есть ли такой в системе
        $user = $authModel->findByEmail($email);
// если пользователь найден и проверен(успешная авторизация), стартуем сессию и пишем в нее id и роль пользователя
        if($user && password_verify($password, $user['password'])){
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];

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