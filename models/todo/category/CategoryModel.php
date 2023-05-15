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
        $todoTableQuery = "CREATE TABLE IF NOT EXISTS `todo_category`(
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `description` TEXT,
            `usability` TINYINT DEFAULT 1,
            `user` INT NOT NULL, 
            FOREIGN KEY (user) REFERENCES users(id) ON DELETE CASCADE
        )";

            try{
                $this->db->exec($todoTableQuery);
                return true;
            }catch(\PDOException $e){
                return false;
            }
    }
// пишем метод для получения всех ролей
    public function getAllCategories(){
        $query = "SELECT * FROM `todo_category`";
        try{
            $stmt = $this->db->prepare($query); // подготавливаем запрос
            $stmt->execute(); // запускаем подготовленный запрос на выполнение
            $todo_category = $stmt->fetchAll(); // получаем массив содержащий все извлеченные строки
            return $todo_category;
        }catch(\PDOException $e){
            return false;
        }
    }
// метод в котором создаем роль
    public function createCategory($title, $description, $user_id){

        $query = "INSERT INTO todo_category (title, description, user) VALUES (?,?,?)";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $description, $user_id]);
            return true;
        }catch(\PDOException $e){
            return false;
        }
    }
// метод для получения конкретной роли по id
    public function getCategoryById($id){
        $query = 'SELECT * FROM todo_category WHERE id = ?';
        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $todo_category = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $todo_category ? $todo_category : false;
        }catch(\PDOException $e){
            return false;
        }
    }

    public function updateCategory($id, $title, $description, $usability){
        $query = "UPDATE todo_category SET title = ?, description = ?, usability = ? WHERE id = ?";
        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $description, $usability,$id]);

            return true;
        }catch(\PDOException $e){
            return false;
        }
    }

    public function deleteCategory($id){
        $query = 'DELETE FROM todo_category WHERE id = ?'; // знак вопроса пишем, чтобы к модели нельзя было обратиться из вне(иньекции и тд)

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]); 
            return true;
        }catch(\PDOException $e){
            return false;
        }
    }
}