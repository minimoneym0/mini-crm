<?php

$title = 'Page list';
ob_start();?>

<h1>Page list</h1>
<a href="?page=pages&action=create" class="btn btn-primary">Create</a>
<table class='table'>
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Page title</th>
            <th scope="col">Page slug</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pages as $page):?>
            <tr>
                <td><?= $page['id'];?></td>
                <td><?= $page['title'];?></td>
                <td><?= $page['slug'];?></td>
                <td>
                    <a href="?page=pages&action=edit&id=<?php echo $page['id']; ?>" class="btn btn-primary">Edit</a>
                    <form method="POST" action="index.php?page=pages&action=delete&id=<?= $page['id'] ?>" class="d-inline-block">
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
    </tbody>
</table>
<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();