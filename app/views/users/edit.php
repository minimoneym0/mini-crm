<?php

$title = 'Edit User';
ob_start();?>

<h1>Edit User</h1>
<form method="post" action="?page=users&action=update&id=<?=$user['id'] ?>"> <!-- указываем action=store, ссылаясь на метод store в UserController -->
    <div class="form-group">
        <label for="login">Login</label>
        <input type="text" class="form-control" id="login" name="login" value="<?=$user['login']?>" required>
    </div>

    <div class="form-group">
        <label for="admin">Admin</label>
        <select name="is_admin" id="admin" class="form-control">
            <option value="1" <?php if($user['is_admin']) echo "selected";?>>Yes</option>
            <option value="0" <?php if(!$user['is_admin']) echo "selected";?>>No</option>
        </select>
    </div>
    <button class="btn btn-primary" type="submit">Edit</button>
</form>

<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();