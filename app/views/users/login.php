<?php

$title = 'Authorization';
ob_start();?>

<h1>Authorization</h1>
<form method="post" action="?page=auth&action=authenticate"> <!-- указываем action=store, ссылаясь на метод store в UserController -->
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember" name="remember">
        <lable class="form-check-label" for="remember">Remember me</lable>
    </div>
    <button class="btn btn-primary" type="submit">Login</button>
</form>
<div class="mt-4">
    <p>Don't have an account? <a href="index.php?page=login">Register here</a></p>
</div>

<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();