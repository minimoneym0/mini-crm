<?php

$title = 'Users list';
ob_start();?>
<h1>Users list</h1>
<a href="/<?= APP_BASE_PATH ?>/users/create" class="btn btn-success">Create User</a>
<table class='table'>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Email verification</th>
            <th scope="col">Is admin</th>
            <th scope="col">Role</th>
            <th scope="col">Is active</th>
            <th scope="col">Last login</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user):?>
            <tr>
                <th scope="row"><?= $user['id'];?></th>
                <td><?= $user['username'];?></td>
                <td><?= $user['email'];?></td>
                <td><?= $user['email_verification'] ? 'Yes' : 'No';?></td>
                <td><?= $user['is_admin'] ? 'Yes' : 'No';?></td>
                <td><?= $user['role'];?></td>
                <td><?= $user['is_active'] ? 'Yes' : 'No';?></td>
                <td><?= $user['last_login'];?></td>
                <td>
                    <a href="/<?= APP_BASE_PATH ?>/users/edit/<?php echo $user['id']; ?>" class="btn btn-primary">Edit</a>
                    <a href="/<?= APP_BASE_PATH ?>/users/delete/<?php echo $user['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
    </tbody>
</table>
<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();