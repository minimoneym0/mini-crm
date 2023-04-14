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
}