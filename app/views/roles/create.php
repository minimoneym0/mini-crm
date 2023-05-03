<?php

$title = 'Create Role';
ob_start();?>

<h1>Create Role</h1>
<form method="post" action="/<?= APP_BASE_PATH ?>/roles/store"> <!-- указываем action=store, ссылаясь на метод store в UserController -->
    <div class="form-group">
        <label for="role_name">Role name</label>
        <input type="text" class="form-control" id="role_name" name="role_name" required>
    </div>
    <div class="form-group">
        <label for="role_descripton">Role description</label>
        <textarea class="form-control" id="role_description" name="role_description" required></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Create Role</button>
</form>

<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();