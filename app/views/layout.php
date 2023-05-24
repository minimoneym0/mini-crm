<!doctype html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/<?= APP_BASE_PATH ?>/app/css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6e56039614.js" crossorigin="anonymous"></script>
    <title><?= $title;?></title>
  </head>
  <body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/<?= APP_BASE_PATH ?>">Home</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/<?= APP_BASE_PATH ?>/users" class="nav-link <?= is_active('/'. APP_BASE_PATH. '/users') ?>">Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="/<?= APP_BASE_PATH ?>/roles" class="nav-link <?= is_active('/'. APP_BASE_PATH. '/roles') ?>">Roles</a>
                    </li>
                    <li class="nav-item">
                        <a href="/<?= APP_BASE_PATH ?>/pages" class="nav-link <?= is_active('/'. APP_BASE_PATH. '/pages') ?>">Pages</a>
                    </li>
                    <li class="nav-item">
                        <a href="/<?= APP_BASE_PATH ?>/auth/register" class="nav-link <?= is_active('/'. APP_BASE_PATH. '/auth/register') ?>">Register</a>
                    </li>
                    <li class="nav-item">
                        <a href="/<?= APP_BASE_PATH ?>/auth/login" class="nav-link <?= is_active('/'. APP_BASE_PATH. '/auth/login') ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="/<?= APP_BASE_PATH ?>/auth/logout" class="nav-link">Logout</a>
                    </li>
                </ul>
                <h3>TODO list : </h3>
                <ul class="navbar-nav">
                <li class="nav-item">
                        <a href="/<?= APP_BASE_PATH ?>/todo/tasks/create" class="nav-link <?= is_active('/'. APP_BASE_PATH. '/todo/tasks/create') ?>">Create task</a>
                    </li>
                    <li class="nav-item">
                        <a href="/<?= APP_BASE_PATH ?>/todo/category" class="nav-link <?= is_active('/'. APP_BASE_PATH. '/todo/category') ?>">Category</a>
                    </li>
                    <li class="nav-item">
                        <a href="/<?= APP_BASE_PATH ?>/todo/tasks" class="nav-link <?= is_active('/'. APP_BASE_PATH. '/todo/tasks') ?>">Tasks(opened)</a>
                    </li>
                    <li class="nav-item">
                        <a href="/<?= APP_BASE_PATH ?>/todo/tasks/completed" class="nav-link <?= is_active('/'. APP_BASE_PATH. '/todo/tasks/completed') ?>">Tasks(completed)</a>
                    </li>
                    <li class="nav-item">
                        <a href="/<?= APP_BASE_PATH ?>/todo/tasks/expired" class="nav-link <?= is_active('/'. APP_BASE_PATH. '/todo/tasks/expired') ?>">Tasks(expired)</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container mt-4">
            <!-- ниже будет выводиться контент из файла app/views/users/index.php -->
            <?= $content; ?> 
        </div>
    </div>  


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
