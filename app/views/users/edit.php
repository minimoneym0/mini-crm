<?php

$title = 'Edit User';
ob_start();?>

<h1>Edit User</h1>
<form method="post" action="users/update/<?=$user['id'] ?>"> <!-- указываем action=store, ссылаясь на метод store в UserController -->
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?=$user['username']?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" value="<?=$user['email']?>" required>
    </div>
    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select name="role" id="role" class="form-control">
            <?php foreach($roles as $role):?>
                <option value="<?= $role['id']; ?>" <?= $user['role'] == $role['id'] ? 'selected' : "";?>><?= $role['role_name']; ?></option>
            <?php endforeach;?>
        </select>
    </div>
    
    <button class="btn btn-primary" type="submit">Save Changes</button>
</form>

<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();