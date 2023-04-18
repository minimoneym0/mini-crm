<?php
// модель получает данные, применяет нужный метод и пишет в базу
class User{
    private $db;
    // конструктором подключаемся к БД, через созданные ранее ф-ии в классе Database
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    // метод, который забирает из БД пользователей и запаковыает их в массив
    public function readAll(){
       $result = $this->db->query("SELECT * FROM users"); // запрос к бд

       // преобразуем данные в массив построчно через fetch_assoc()
       while($row=$result->fetch_assoc()){
            $users[] = $row;
       }
       return $users;
    }

    public function create($data){
        // забираем данные из формы, передаем в подготовленный запрос 
        $login = $data['login'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT); // получаем пароль и хешируем
        $admin = ($data['is_admin']) ? 1 : 0;
        $created_at = date('Y-m-d H:i:s');
        // подготавливаем запрос
        $stmt = $this->db->prepare("INSERT INTO users (login, password, is_admin, created_at) VALUE (?,?,?,?)");
        // передаем параметры в подготовленный запрос
        $stmt->bind_param("ssis", $login, $password, $admin, $created_at);
        // если запрос проходит возвращаем true, иначе false
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function delete($id){
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = ?'); // знак вопроса пишем, чтобы к модели нельзя было обратиться из вне(иньекции и тд)
        $stmt -> bind_param("i", $id); 

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}