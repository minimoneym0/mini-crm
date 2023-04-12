<?php
// app/models/Database.php

class Database{
    private static $instance = null;

    private $conn;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = 'root';
    private $name_db = 'minicrm';

    // создаем конструктор с подключением к бд
    private function __construct()
    {   // объект подключения к бд
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name_db); // указываем параметры подключения к бд, подключаемся
        if($this->conn->connect_error) die('connect failed'.$this->conn->connect_error); // проверяем коннект к бд
    }

    // создаем метод, возвращающий объект класса Database
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // метод возвращает объект подключения к бд
    public function getConnection(){
        return $this->conn;
    }

}