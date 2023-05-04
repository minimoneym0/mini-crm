<?php
namespace models\pages;

use models\Database;
// модель получает данные, применяет нужный метод и пишет в базу
class PageModel{
    private $db;
    // конструктором подключаемся к БД, через созданные ранее ф-ии в классе Database
    // затем смотрим, если таблица с пользователями уже есть, то ничего не делаем, если нет, то отправляем запрос на создание таблицы 
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try{
            $result = $this->db->query("SELECT 1 FROM `pages` LIMIT 1");
        }catch(\PDOException $e){
            $this->createDbTable();
        }
    }

    public function createDbTable(){
        $pageTableQuery = "CREATE TABLE IF NOT EXISTS `pages`(
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `slug` VARCHAR(255) NOT NULL,
            `role` VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `update_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

            try{
                $this->db->exec($pageTableQuery);
                return true;
            }catch(\PDOException $e){
                return false;
            }
    }
// пишем метод для получения всех страниц
    public function getAllPages(){
        $query = "SELECT * FROM `pages`";
        try{
            $stmt = $this->db->prepare($query); // подготавливаем запрос
            $stmt->execute(); // запускаем подготовленный запрос на выполнение
            $pages = $stmt->fetchAll(); // получаем массив содержащий все извлеченные строки
            return $pages;
        }catch(\PDOException $e){
            return false;
        }
    }
// метод в котором создаем страницу
    public function createPage($title, $slug){

        $query = "INSERT INTO pages (title, slug) VALUES (?,?)";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $slug]);
            return true;
        }catch(\PDOException $e){
            return false;
        }
    }
// метод для получения конкретной роли по id
    public function getPageById($id){
        $query = 'SELECT * FROM pages WHERE id = ?';
        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $page = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $page ? $page : false;
        }catch(\PDOException $e){
            return false;
        }
    }

    public function updatePage($id, $title, $slug){
        $query = "UPDATE pages SET title = ?, slug = ? WHERE id = ?";
        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $slug, $id]);

            return true;
        }catch(\PDOException $e){
            return false;
        }
    }

    public function deletePage($id){
        $query = 'DELETE FROM pages WHERE id = ?'; // знак вопроса пишем, чтобы к модели нельзя было обратиться из вне(иньекции и тд)

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]); 
            return true;
        }catch(\PDOException $e){
            return false;
        }
    }
}