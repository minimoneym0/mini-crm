<?php

$title = 'Task create';
ob_start(); 
?>

  <h1 class="mb-4">Task create</h1>
    <form method="POST" action="/<?= APP_BASE_PATH ?>/todo/tasks/store">
    <div class="row">
        <!-- Title field -->
        <div class="mb-3 col-12 col-md-12">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
    </div>
    <div class="row">
        <!-- Category field -->
      <div class="col-12 col-md-6 mb-3">
        <label for="category_id">Category</label>
        <select class="form-control" id="category_id" name="category_id" required>
          <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <!-- Finish date field -->
      <div class="col-12 col-md-6 mb-3">
          <label for="finish_date">Finish Date</label>
          <input type="text" class="form-control" id="finish_date" name="finish_date" placeholder="Укажите время и дату">
      </div>
    </div>
        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>

    <script>
      document.addEventListener('DOMContentLoaded', function(){
        flatpickr("#finish_date", {
          enableTime: true,
          dateFormat: "Y-m-d H:00:00", // дата и время без минут и секунд
          noCalendar : false,
          time_24hr: true,
          minuteIncrement: 60 // интервал времени один час
        });
      });
    </script>

<?php $content = ob_get_clean(); 

include 'app/views/layout.php';
?>