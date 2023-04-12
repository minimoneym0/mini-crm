<?php

$title = 'Users list';
ob_start();?>

<h1>Users list</h1>
<a href="#" class="btn btn-success">Create User</a>
<table class='table'>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Login</th>
            <th scope="col">Admin</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user):?>
            <tr>
                <th scope="row"><?= $user['id'];?></th>
                <td><?= $user['login'];?></td>
                <td><?= $user['is_admin'];?></td>
                <td><?= $user['created_at'];?></td>
                <td>
                    <a href="index.php?page=users&action=edit&id=<?php echo $user['id']; ?>" class="btn btn-primary">Edit</a>
                    <a href="index.php?page=users&action=delete&id=<?php echo $user['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
    </tbody>
</table>
<?php $content = ob_get_clean();
include '';