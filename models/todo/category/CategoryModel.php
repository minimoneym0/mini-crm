<?php
namespace models\todo\category;

use models\Database;

// модель получает данные, применяет нужный метод и пишет в базу
class CategoryModel{
    private $db;
    // конструктором подключаемся к БД, через созданные ранее ф-ии в классе Database
    // затем смотрим, если таблица с пользователями уже есть, то ничего не делаем, если нет, то отправляем запрос на создание таблицы users
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try{
            $result = $this->db->query("SELECT 1 FROM `todo_category` LIMIT 1");
        }catch(\PDOException $e){
            $this->createDbTable();
        }
    }

    public function createDbTable(){
        $roleTableQuery = "CREATE TABLE IF NOT EXISTS `todo_category`(
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `description` TEXT,
            'usability' TINYINT DEFAULT 1,
            'user' INT NOT NULL, 
            FOREING KEY (user) REFERENCES users(id) ON DELETE CASCADE
        )";

            try{
                $this->db->exec($roleTableQuery);
                return true;
            }catch(\PDOException $e){
                return false;
            }
    }
// пишем метод для получения всех ролей
    public function getAllRoles(){
        $query = "SELECT * FROM `roles`";
        try{
            $stmt = $this->db->prepare($query); // подготавливаем запрос
            $stmt->execute(); // запускаем подготовленный запрос на выполнение
            $roles = $stmt->fetchAll(); // получаем массив содержащий все извлеченные строки
            return $roles;
        }catch(\PDOException $e){
            return false;
        }
    }
// метод в котором создаем роль
    public function createRole($role_name, $role_description){

        $query = "INSERT INTO roles (role_name, role_description) VALUES (?,?)";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$role_name, $role_description]);
            return true;
        }catch(\PDOException $e){
            return false;
        }
    }
// метод для получения конкретной роли по id
    public function getRoleById($id){
        $query = 'SELECT * FROM roles WHERE id = ?';
        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $role = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $role ? $role : false;
        }catch(\PDOException $e){
            return false;
        }
    }

    public function updateRole($id, $role_name, $role_description){
        $query = "UPDATE roles SET role_name = ?, role_description = ? WHERE id = ?";
        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$role_name, $role_description, $id]);

            return true;
        }catch(\PDOException $e){
            return false;
        }
    }

    public function deleteRole($id){
        $query = 'DELETE FROM roles WHERE id = ?'; // знак вопроса пишем, чтобы к модели нельзя было обратиться из вне(иньекции и тд)

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]); 
            return true;
        }catch(\PDOException $e){
            return false;
        }
    }
}