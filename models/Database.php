<?php
namespace models;

class Database{
    private static $instance = null;

    private $conn;

    // создаем конструктор с подключением к бд
    private function __construct()
    {
        $db_host = DB_HOST;
        $db_user = DB_USER;
        $db_pass = DB_PASS;
        $db_name_db = DB_NAME;

        try{
            // пишем коннектор, будем получать хост и имя БД
            $dsn = "mysql:host=$db_host;dbname=$db_name_db";
            $this->conn = new \PDO($dsn, $db_user, $db_pass); // создаем экземпляр PDO и передаем данные
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); // передаем считывание ошибок и исключений
        }catch(\PDOException $e){
            // если подключение не сработает, выведет ошибки
            echo "Connect failed: ".$e->getMessage(); 
        }
    }

    // создаем метод, возвращающий объект класса Database
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    // метод возвращает объект подключения к бд
    public function getConnection(){
        return $this->conn;
    }

}