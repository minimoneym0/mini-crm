<?php

$title = 'Create User';
ob_start();?>

<h1>Create User</h1>
<form method="post" action="">
    <div class="form-group">
        <label for="login">Login</label>
        <input type="text" class="form-control" id="login" name="login" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
    </div>
    <div class="form-group">
        <label for="admin">Admin</label>
        <select name="admin" id="admin" class="form-control">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
    </div>
    <button class="btn btn-primary" type="submit">Create</button>
</form>


<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();