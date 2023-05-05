<?php
namespace models;

use models\pages\PageModel;

class Check{
    private $userRole;
    public function __construct($userRole)
    {
        $this->userRole = $userRole;
    }

    public function getCurUrlSlug(){
        $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // собираем урл

        $parseUrl = parse_url($url); // парсим наш урл на части

        $path = $parseUrl['path']; // получаем конечную часть из урла
        $pathWithoutBase = str_replace(APP_BASE_PATH, '', $path);
// сегментируем на части
        $segments = explode('/', ltrim($pathWithoutBase, '/'));
        $firstTwoSegments = array_slice($segments, 0, 2); // берем первые 2 элем массива
        $slug = implode('/', $firstTwoSegments); // соединяем в строку через слеш
        return $slug; // удаляем слеш в начале строки
    }

    public function checkPermission($slug){
        // получим инфо о странице по slug
        $pageModel = new PageModel();
        $page = $pageModel->findBySlug($slug);
        if(!$page) return false;

        // получим разрешенные роли для страницы
        $allOwedRoles = explode(',', $page['role']);
        // проверим, имеет ли текущий пользователь доступ к странице
        if(isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], $allOwedRoles)){
            return true;
        }else{
            return false;
        }
    }

    public function requirePermission(){
        $slug = $this->getCurUrlSlug(); // получаем slug
        //проверим права пользователя и если нет прав выкинем на главную
        if(!$this->checkPermission($slug)){
            $path = '/'. APP_BASE_PATH;
            header("Location: $path");
            exit();
        }
    }

    // public function isCurUserRole($role){
    //     return $this->userRole == $role;
    // }
}