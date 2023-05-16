<?php

$title = 'Edit Category';
ob_start();?>

<h1>Edit Category</h1>
<form method="post" action="/<?= APP_BASE_PATH ?>/todo/category/update">
    <input type="hidden" name="id" value="<?= $category['id']?>">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?=$category['title']?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Category description</label>
        <textarea class="form-control" id="description" name="description" required><?=$category['description']?></textarea>
    </div>
    
    <button class="btn btn-primary" type="submit">Update Category</button>
</form>

<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();