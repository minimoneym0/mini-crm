<?php

$title = 'TODO task list - completed';
ob_start();?>

<h1 class="mb-4">Todo List completed</h1>
    <div class="d-flex justify-content-around row filter-priority">
        <a data-priority="low" class="btn mb-3 col-2 sort-btn" style="background: #90d882">Low</a>
        <a data-priority="medium" class="btn mb-3 col-2 sort-btn" style="background: #f6f46b">Medium</a>
        <a data-priority="high" class="btn mb-3 col-2 sort-btn" style="background: #f6b66b">High</a>
        <a data-priority="urgent" class="btn mb-3 col-2 sort-btn" style="background: #f6786b">Urgent</a>
    </div>
    <div class="accordion" id="tasks-accordion">
        <?php foreach ($completedTasks as $oneTask): 
            $priorityColor = '';
            switch ($oneTask['priority']) {
                case 'low':
                    $priorityColor = '#90d882';
                    break;
                case 'medium':
                    $priorityColor = '#f6f46b';
                    break;
                case 'high':
                    $priorityColor = '#f6b66b';
                    break;
                case 'urgent':
                    $priorityColor = '#f6786b';
                    break;
                }
            ?>

            <div class="accordion-item mb-2">
                <div class="accordion-header d-flex justify-content-between align-items-center row" id="task-<?php echo $oneTask['id']; ?>">
                    <h2 class="accordion-header col-12 col-md-6">
                        <button style="background: <?=$priorityColor; ?>" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#task-collapse-<?php echo $oneTask['id']; ?>" aria-expanded="false" aria-controls="task-collapse-<?php echo $oneTask['id']; ?>" data-priority="<?php echo $oneTask['priority']; ?>">
                            <span class="col-12 col-md-5"><i class="fa-solid fa-square-up-right"></i> <strong><?php echo $oneTask['title']; ?> </strong></span>
                            <span class="col-5 col-md-3"><i class="fa-solid fa-person-circle-question"></i> <?php echo $oneTask['status']; ?> </span>
                            <span class="col-5 col-md-3"><i class="fa-solid fa-hourglass-start"></i><span class="due-date"><?php echo $oneTask['finish_date']; ?></span></span>
                        </button>
                    </h2>
                </div>
                <div id="task-collapse-<?php echo $oneTask['id']; ?>" class="accordion-collapse collapse row" aria-labelledby="task-<?php echo $oneTask['id']; ?>" data-bs-parent="#tasks-accordion">
                <div class="accordion-body">
                        <p class="row">
                            <span class="col-12 col-md-6"><strong><i class="fa-solid fa-layer-group"></i> Category:</strong> <?php echo htmlspecialchars($oneTask['category']['title'] ?? 'N/A'); ?></span>
                            <span class="col-12 col-md-6"><strong><i class="fa-solid fa-battery-three-quarters"></i> Status:</strong> <?php echo htmlspecialchars($oneTask['status']); ?></span>
                        </p>
                        <p class="row">
                            <span class="col-12 col-md-6"><strong><i class="fa-solid fa-person-circle-question"></i> Priority:</strong> <?php echo htmlspecialchars($oneTask['priority']); ?></span>
                            <span class="col-12 col-md-6"><strong><i class="fa-solid fa-hourglass-start"></i> Due Date:</strong> <?php echo htmlspecialchars($oneTask['finish_date']); ?></span>
                        </p>
                        <p><strong><i class="fa-solid fa-file-prescription"></i> Tags:</strong> 
                            <?php foreach ($oneTask['tags'] as $tag): ?>
                                <a href="/<?= APP_BASE_PATH ?>/todo/tasks/by-tag/<?= $tag['id'] ?>" class="tag"><?= htmlspecialchars($tag['name']) ?></a>
                            <?php endforeach; ?>
                        </p>
                        <p>
                            <strong><i class="fa-solid fa-file-prescription"></i> Description:</strong> <em><?php echo htmlspecialchars($oneTask['description'] ?? ''); ?></em>
                        </p>
                        <hr>
                        <div class="d-flex justify-content-start action-task">

                            <a href="/<?= APP_BASE_PATH ?>/todo/tasks/edit/<?php echo $oneTask['id']; ?>" class="btn btn-primary me-2">Edit</a>
                            <a href="/<?= APP_BASE_PATH ?>/todo/tasks/delete/<?php echo $oneTask['id']; ?>" class="btn btn-danger me-2">Delete</a>
                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();