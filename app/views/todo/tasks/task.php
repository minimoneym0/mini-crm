<?php

$title = 'TODO task page';
ob_start();?>

<h1 class="mb-4">TODO task page</h1>

<div class="card mb-4">
    <div class="card-header">
        <h1 class="card-title">
            <i class="fa-solid fa-square-up-right"></i> <strong><?php echo $task['title']; ?> </strong>
        </h1>
    </div>
    <div class="card-body">
        <p class="row">
            <span class="col-12 col-md-6"><strong><i class="fa-solid fa-layer-group"></i> Category:</strong> <?php echo htmlspecialchars($category['title'] ?? 'N/A'); ?></span>
            <span class="col-12 col-md-6"><strong><i class="fa-solid fa-battery-three-quarters"></i> Status:</strong> <?php echo htmlspecialchars($task['status']); ?></span>
        </p>
        <p class="row">
            <span class="col-12 col-md-6"><strong><i class="fa-solid fa-person-circle-question"></i> Priority:</strong> <?php echo htmlspecialchars($task['priority']); ?></span>
            <span class="col-12 col-md-6"><strong><i class="fa-solid fa-hourglass-start"></i> Start Date:</strong> <?php echo htmlspecialchars($task['created_at']); ?></span>
        </p>
        <p class="row">
            <span class="col-12 col-md-6"><strong><i class="fa-solid fa-person-circle-question"></i> Updated:</strong> <?php echo htmlspecialchars($task['updated_at']); ?></span>
            <span class="col-12 col-md-6"><strong><i class="fa-solid fa-hourglass-start"></i> Due Date:</strong> <?php echo htmlspecialchars($task['finish_date']); ?></span>
        </p>
        <p><strong><i class="fa-solid fa-file-prescription"></i> Tags:</strong> 
            <?php foreach ($tags as $tag): ?>
                <a href="/<?= APP_BASE_PATH ?>/todo/tasks/by-tag/<?= $tag['id'] ?>" class="tag"><?= htmlspecialchars($tag['name']) ?></a>
            <?php endforeach; ?>
        </p>
        <hr>
        <p><strong><i class="fa-solid fa-file-prescription"></i> Description:</strong> <em><?php echo htmlspecialchars($task['description'] ?? ''); ?></em></p>
        <hr>
        <div class="d-flex justify-content-start action-task">
            <a href="/<?= APP_BASE_PATH ?>/todo/tasks/edit/<?php echo $task['id']; ?>" class="btn btn-primary me-2">Edit</a>
            <a href="/<?= APP_BASE_PATH ?>/todo/tasks/delete/<?php echo $task['id']; ?>" class="btn btn-danger me-2">Delete</a>
        </div>
    </div>
</div>

    

<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();