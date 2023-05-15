<?php

$title = 'Create TODO Category';
ob_start();?>

<h1>Create TODO Category</h1>
<form method="post" action="/<?= APP_BASE_PATH ?>/todo/category/store"> <!-- указываем action=store, ссылаясь на метод store в UserController -->
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
        <label for="descripton">Description</label>
        <textarea class="form-control" id="descripton" name="descripton" required></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Create Description</button>
</form>
<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();