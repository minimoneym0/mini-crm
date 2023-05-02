<?php
namespace models\users;

use models\Database;

// модель получает данные, применяет нужный метод и пишет в базу
class User{
    private $db;
    // конструктором подключаемся к БД, через созданные ранее ф-ии в классе Database
    // затем смотрим, если таблица с пользователями уже есть, то ничего не делаем, если нет, то отправляем запрос на создание таблицы users
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try{
            $result = $this->db->query("SELECT 1 FROM `roles` LIMIT 1");
        }catch(\PDOException $e){
            $this->createDbTable();
        }
    }

    public function createDbTable(){
        $roleTableQuery = "CREATE TABLE IF NOT EXISTS `roles`(
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `role_name` VARCHAR(255) NOT NULL,
            `role_description` TEXT
        )";

        $userTableQuery = "CREATE TABLE IF NOT EXISTS `users`(
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `username` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `email_verification` TINYINT(1) NOT NULL DEFAULT 0,
            `password` VARCHAR(255) NOT NULL,
            `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
            `role` INT(11) NOT NULL DEFAULT 0,
            `is_active` TINYINT(1) NOT NULL DEFAULT 1,
            `last_login` TIMESTAMP NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)#,
#            FOREIGN KEY (`role`) REFERENCES `roles` (`id`)
            )";

            try{
                $this->db->exec($roleTableQuery);
                $this->db->exec($userTableQuery);
                return true;
            }catch(\PDOException $e){
                return false;
            }
    }

    public function readAll(){
        try{
            $stmt = $this->db->query("SELECT * FROM `users`");
            $users = [];
            while($row=$stmt->fetch(\PDO::FETCH_ASSOC)){
                $users[] = $row;
            }
            return $users;
        }catch(\PDOException $e){
                return false;
        }
    } 

    public function create($data){
        // забираем данные из формы, передаем в подготовленный запрос 
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $role = $data['role'];
        $created_at = date('Y-m-d H:i:s');
        // подготавливаем запрос
        $query = "INSERT INTO `users` (username, email, password, role, created_at) VALUE (?,?,?,?,?)";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username, $email, $password, $role, $created_at]);
            return true;
        }catch(\PDOException $e){
            return false;
        }
    }

    public function delete($id){
        $query = 'DELETE FROM users WHERE id = ?'; // знак вопроса пишем, чтобы к модели нельзя было обратиться из вне(иньекции и тд)

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]); 
            return true;
        }catch(\PDOException $e){
            return false;
        }
    }

    public function read($id){
        $query = 'SELECT * FROM users WHERE id = ?';
        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }catch(\PDOException $e){
            return false;
        }
    }

    public function update($id, $data){
        // забираем данные из формы, передаем в подготовленный запрос 
        $username = $data['username'];
        $admin = !empty($data['admin']) && $data['admin'] !== 0 ? 1 : 0;
        $email = $data['email'];
        $role = $data['role'];
        // подготавливаем запрос
        $query = "UPDATE users SET username = ?, is_admin = ?, email = ?, role = ? WHERE id = ?";
        
        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username, $admin, $email, $role, $id]);
        }catch(\PDOException $e){
            return false;
        }
       
    }
}