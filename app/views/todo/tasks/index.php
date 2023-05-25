<?php

$title = 'TODO task list';
ob_start();?>

<h1 class="mb-4">Todo List</h1>
    <div class="accordion" id="tasks-accordion">
        <?php foreach ($tasks as $task): ?>
            <?php
                $priorityColor = '';
                switch($task['priority']){
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
                <div class="accordion-header d-flex justify-content-between align-items-center row" id="task-<?php echo $task['id']; ?>">
                    <h2 class="accordion-header col-12 col-md-6">
                        <button class="accordion-button collapsed" style="background:<?=$priorityColor;?>" type="button" data-bs-toggle="collapse" data-bs-target="#task-collapse-<?php echo $task['id']; ?>" aria-expanded="false" aria-controls="task-collapse-<?php echo $task['id']; ?>">
                            <span class="col-12 col-md-5"><i class="fa-solid fa-square-up-right"></i> <strong><?php echo $task['title']; ?> </strong></span>
                            <span class="col-5 col-md-3"><i class="fa-solid fa-person-circle-question"></i> <?php echo $task['priority']; ?> </span>
                            <span class="col-5 col-md-3"><i class="fa-solid fa-hourglass-start"></i><span class="due-date"><?php echo $task['finish_date']; ?></span></span>
                        </button>
                    </h2>
                </div>
                <div id="task-collapse-<?php echo $task['id']; ?>" class="accordion-collapse collapse row" aria-labelledby="task-<?php echo $task['id']; ?>" data-bs-parent="#tasks-accordion">
                    <div class="accordion-body">
                    <p class="row">
                            <span class="col-12 col-md-6"><strong><i class="fa-solid fa-layer-group"></i> Category:</strong> <?php echo htmlspecialchars($task['category']['title'] ?? 'N/A'); ?></span>
                            <span class="col-12 col-md-6"><strong><i class="fa-solid fa-battery-three-quarters"></i> Status:</strong> <?php echo htmlspecialchars($task['status']); ?></span>
                        </p>
                        <p class="row">
                            <span class="col-12 col-md-6"><strong><i class="fa-solid fa-person-circle-question"></i> Priority:</strong> <?php echo htmlspecialchars($task['priority']); ?></span>
                            <span class="col-12 col-md-6"><strong><i class="fa-solid fa-hourglass-start"></i> Due Date:</strong> <?php echo htmlspecialchars($task['finish_date']); ?></span>
                        </p>
                        <p><strong><i class="fa-solid fa-file-prescription"></i> Tags:</strong> 
                            <?php foreach ($task['tags'] as $tag): ?>
                                <a href="/<?= APP_BASE_PATH ?>/todo/tasks/by-tag/<?= $tag['id'] ?>" class="tag"><?= htmlspecialchars($tag['name']) ?></a>
                            <?php endforeach; ?>
                        </p>
                        <p>
                            <strong><i class="fa-solid fa-file-prescription"></i> Description:</strong> <em><?php echo htmlspecialchars($task['description'] ?? ''); ?></em>
                        </p>
                        <hr>
                        <div class="d-flex justify-content-start action-task">

                            <a href="/<?= APP_BASE_PATH ?>/todo/tasks/edit/<?php echo $task['id']; ?>" class="btn btn-primary me-2">Edit</a>
                            <a href="/<?= APP_BASE_PATH ?>/todo/tasks/delete/<?php echo $task['id']; ?>" class="btn btn-danger me-2">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


<script>
    function updateRemainingTime() {
        const dueDateElements = document.querySelectorAll('.due-date');
        const now = new Date();

        dueDateElements.forEach((element) => {
            const dueDate = new Date(element.textContent);
            const timeDiff = dueDate - now;

            if (timeDiff > 0) {
                const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));

                element.textContent = `Days: ${days} Hours: ${hours}`;
            } else {
                element.textContent = 'Time is up';
            }
        });
    }

    updateRemainingTime();
    setInterval(updateRemainingTime, 60000); // Update every minute
</script>

    

<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();