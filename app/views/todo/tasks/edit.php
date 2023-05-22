<?php

$title = 'Edit Task';
ob_start();?>

<h1 class="mb-4">Edit Task</h1>
<form action="/<?= APP_BASE_PATH ?>/todo/tasks/update" method="post">
    <input type="hidden" name="id" value="<?= $task['id']?>">
    <div class="row">
        <!-- Title field -->
        <div class="col-12 col-md-6 mb-3">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
        </div>
    </div>
</form>


<?php $content = ob_get_clean();

include 'app/views/layout.php';