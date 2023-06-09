<?php

$title = 'Edit Page';
ob_start();
?>

<h1>Edit Page</h1>
<form method="post" action="/<?= APP_BASE_PATH ?>/pages/update">
    <input type="hidden" name="id" value="<?= $page['id']?>">
    <div class="mb-3">
        <label for="title" class="form-label">Page title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?=$page['title']?>" required>
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">Page slug</label>
        <input type="text" class="form-control" id="slug" name="slug" value="<?=$page['slug']?>" required>
    </div>
    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <? $page_roles = explode(',',$page['role']);
        foreach($roles as $role):?>
            <input type="checkbox" name="roles[]" value="<?= $role['id']?>" <?= in_array($role['id'], $page_roles) ? "checked" : "";?>><?=$role['role_name'];?>
        <? endforeach;?>
    </div>
    
    <button class="btn btn-primary" type="submit">Update Page</button>
</form>

<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();