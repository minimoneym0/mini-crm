<?php
// app/models/Database.php

class Database{
    private static $instance = null;

    private $conn;

    // создаем конструктор с подключением к бд
    private function __construct()
    {   // объект подключения к бд через PDO
        $config = require_once __DIR__ . '/../../config.php'; // подключаемся к конфигу
        $db_host = $config['db_host'];
        $db_user = $config['db_user'];
        $db_pass = $config['db_pass'];
        $db_name_db = $config['db_name_db'];

        try{
            // пишем коннектор, будем получать хост и имя БД
            $dsn = "mysql:host=$db_host;dbname=$db_name_db";
            $this->conn = new PDO($dsn, $db_user, $db_pass); // создаем экземпляр PDO и передаем данные
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // передаем считывание ошибок и исключений
        }catch(PDOException $e){
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