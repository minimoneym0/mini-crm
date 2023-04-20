<?php
// модель получает данные, применяет нужный метод и пишет в базу
class User{
    private $db;
    // конструктором подключаемся к БД, через созданные ранее ф-ии в классе Database
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function readAll(){
        try{
            $stmt = $this->db->query("SELECT * FROM `users`");

            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                $users[] = $row;
            }
            return $users;
        }catch(PDOException $e){
                return false;
        }
    } 

    public function create($data){
        // забираем данные из формы, передаем в подготовленный запрос 
        $login = $data['login'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT); // получаем пароль и хешируем
        $admin = ($data['is_admin']) ? 1 : 0;
        $created_at = date('Y-m-d H:i:s');
        // подготавливаем запрос
        $query = "INSERT INTO users (login, password, is_admin, created_at) VALUE (?,?,?,?)";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$login, $password, $admin, $created_at]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id){
        $query = 'DELETE FROM users WHERE id = ?'; // знак вопроса пишем, чтобы к модели нельзя было обратиться из вне(иньекции и тд)

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]); 
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function read($id){
        $query = 'SELECT * FROM users WHERE id = ?';
        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return false;
        }
    }

    public function update($id, $data){
        // забираем данные из формы, передаем в подготовленный запрос 
        $login = $data['login'];
        $admin = ($data['is_admin']) ? 1 : 0;
        // подготавливаем запрос
        $query = "UPDATE users SET login = ?, is_admin = ? WHERE id = ?";
        
        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$login,$admin,$id]);
        }catch(PDOException $e){
            return false;
        }
       
    }
}