<?php

spl_autoload_register(function ($class){
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $classPath = __DIR__ . DIRECTORY_SEPARATOR . $class . 'php'; // собираем путь к файлу класса

    // пишем проверку существования файла в директории
    if(file_exists($classPath)){ // проверяем наличие файла
        require_once $classPath; //  и подключаем его
    }else{
        $class = str_replace('app/controllers', 'controllers', $class);
        $classPath = __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';

        if(file_exists($classPath)){
            require_once $classPath;
        }else{
            throw new Exception("Class {$class} not found in {$classPath}");
        }
    }

}
);