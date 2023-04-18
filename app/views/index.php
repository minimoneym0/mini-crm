<?php

$title = 'Home page';
ob_start();?>

<h1>Home page</h1>

<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();