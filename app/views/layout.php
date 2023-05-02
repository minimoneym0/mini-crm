<!doctype html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title;?></title>
  </head>
  <body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/<?= APP_BASE_PATH ?>">Home</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/<?= APP_BASE_PATH ?>/users" class="nav-link">Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="/<?= APP_BASE_PATH ?>/roles" class="nav-link">Roles</a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=pages" class="nav-link">Pages</a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=register" class="nav-link">Register</a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=login" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=logout" class="nav-link">Logout</a>
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
