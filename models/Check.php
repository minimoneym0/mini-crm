<?php
namespace models;

class Check{
    public function getCurUrlSlug(){
        $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // собираем урл

        $parseUrl = parse_url($url); // парсим наш урл на части

        $path = $parseUrl['path']; // получаем конечную часть из урла
    }
}