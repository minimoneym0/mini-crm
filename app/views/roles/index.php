<?php

$title = 'Roles list';
ob_start();?>

<h1>Roles list</h1>
<table class='table'>
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Role name</th>
            <th scope="col">Role description</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($roles as $role):?>
            <tr>
                <td><?= $role['id'];?></td>
                <td><?= $role['role_name'];?></td>
                <td><?= $role['role_description'];?></td>
                <td>
                    <a href="?page=roles&action=edit&id=<?php echo $role['id']; ?>" class="btn btn-primary">Edit</a>
                    <form method="POST" action="index.php?page=roles&action=delete&id=<?= $role['id'] ?>" class="d-inline-block">
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
    </tbody>
</table>
<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();