<?php

$title = 'Page list';
ob_start();?>

<h1>Page list</h1>
<a href="/<?= APP_BASE_PATH ?>/pages/create" class="btn btn-primary">Create</a>
<table class='table'>
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Page title</th>
            <th scope="col">Page slug</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pages as $page):?>
            <tr>
                <td><?= $page['id'];?></td>
                <td><?= $page['title'];?></td>
                <td><?= $page['slug'];?></td>
                <td><?= $page['role'];?></td>
                <td>
                    <a href="/<?= APP_BASE_PATH ?>/pages/edit/<?php echo $page['id']; ?>" class="btn btn-primary">Edit</a>
                    <form method="POST" action="/<?= APP_BASE_PATH ?>/pages/delete/<?= $page['id'] ?>" class="d-inline-block">
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
    </tbody>
</table>
<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();