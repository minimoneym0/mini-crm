<?php
namespace models\todo\tasks;

use models\Database;

// модель получает данные, применяет нужный метод и пишет в базу
class TaskModel{
    private $db;
    private $userID;
    // конструктором подключаемся к БД, через созданные ранее ф-ии в классе Database
    // затем смотрим, если таблица с пользователями уже есть, то ничего не делаем, если нет, то отправляем запрос на создание таблицы users
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        $this->userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null; // присваиваем id пользователя в сессии
        try{
            $result = $this->db->query("SELECT 1 FROM `todo_list` LIMIT 1");
        }catch(\PDOException $e){
            $this->createDbTable();
        }
    }

    public function createDbTable(){
        $todoTableQuery = "CREATE TABLE IF NOT EXISTS `todo_list`(
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NOT NULL,
            `title` VARCHAR(255) NOT NULL,
            `description` TEXT,
            `category_id` INT NOT NULL,
            `status` ENUM('new', 'in_progress', 'completed', 'on_hold', 'cancelled') NOT NULL,
            `priority` ENUM('low', 'medium', 'high', 'urgent') NOT NULL, 
            `assigned_to` INT, 
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP, 
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
            `finish_date` DATETIME,
            `completed_at` DATETIME,
            `reminder_at` DATETIME,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (category_id) REFERENCES todo_category(id),
            FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL
        )";

            try{
                $this->db->exec($todoTableQuery);
                return true;
            }catch(\PDOException $e){
                return false;
            }
    }
// пишем метод для получения всех ролей
    public function getAllTasks(){
        $query = "SELECT * FROM todo_list WHERE user_id = ?";
        try{
            $stmt = $this->db->prepare($query); // подготавливаем запрос
            $stmt->execute([$this->userID]); // запускаем подготовленный запрос на выполнение
            $todo_list = $stmt->fetchAll(); // получаем массив содержащий все извлеченные строки
            return $todo_list;
        }catch(\PDOException $e){
            return false;
        }
    }
// метод в котором создаем роль
    public function createTask($data){

        $query = "INSERT INTO todo_list (user_id, title, category_id, status, priority, finish_date) VALUES (?,?,?,?,?,?)";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['user_id'], $data['title'], $data['category_id'], $data['status'], $data['priority'], $data['finish_date']]);
            return true;
        }catch(\PDOException $e){
            return false;
        }
    }
// метод для получения конкретной роли по id
    public function getTaskById($id){
        $query = 'SELECT * FROM todo_list WHERE id = ?';
        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $todo_task = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $todo_task ? $todo_task : false;
        }catch(\PDOException $e){
            return false;
        }
    }

    public function updateCategory($id, $title, $description, $usability){
        $query = "UPDATE todo_list SET title = ?, description = ?, usability = ? WHERE id = ?";
        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $description, $usability, $id]);

            return true;
        }catch(\PDOException $e){
            return false;
        }
    }

    public function deleteTask($id){
        $query = 'DELETE FROM todo_list WHERE id = ?'; // знак вопроса пишем, чтобы к модели нельзя было обратиться из вне(иньекции и тд)

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]); 
            return true;
        }catch(\PDOException $e){
            return false;
        }
    }
}