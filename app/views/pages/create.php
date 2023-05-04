<?php

$title = 'Create Page';
ob_start();?>

<h1>Create Page</h1>
<form method="post" action="/<?= APP_BASE_PATH ?>/pages/store"> <!-- указываем action=store, ссылаясь на метод store в UserController -->
    <div class="form-group">
        <label for="title">Page title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
        <label for="slug">Page slug</label>
        <input type="text" class="form-control" id="slug" name="slug" required>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <input type="text" class="form-control" id="role" name="role" required>
    </div>
    <button class="btn btn-primary" type="submit">Create Page</button>
</form>

<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();