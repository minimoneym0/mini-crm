<?php
// редирект с index.php на /
if($_SERVER['REQUEST_URI'] == '/minicrm/index.php'){
    header('Location: /minicrm');
}

$title = 'Home page';
ob_start();?>

<h1>Home page</h1>

<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();