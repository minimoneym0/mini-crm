<?php

$title = 'TODO Category list';
ob_start();?>

<h1>TODO Category list</h1>
<a href="/<?= APP_BASE_PATH ?>/todo/category/create">Create Category</a>
<table class='table'>
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Usability</th>
            <th scope="col">User</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($categories as $category):?>
            <tr>
                <td><?= $category['id'];?></td>
                <td><?= $category['title'];?></td>
                <td><?= $category['description'];?></td>
                <td><?= $category['usability'];?></td>
                <td><?= $category['user'];?></td>
                <td>
                    <a href="/<?= APP_BASE_PATH ?>/todo/category/edit/<?=$category['id']; ?>" class="btn btn-primary">Edit</a>
                    <form method="POST" action="/<?= APP_BASE_PATH ?>/todo/category/delete/<?= $category['id'] ?>" class="d-inline-block">
                    <!-- <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button> -->
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
    </tbody>
</table>
<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();