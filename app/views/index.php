<?php
// редирект с index.php на /
if($_SERVER['REQUEST_URI'] == APP_BASE_PATH.'/index.php'){
    header('Location: /minicrm');
}

$title = 'Home page';
ob_start();?>

<h1>Home page</h1>
<!-- размещаем див с календарем -->
<div id='calendar'></div>

<?php $path = '/'. APP_BASE_PATH . '/todo/tasks/task/';?>
<!-- пишем скрипт для вывода календаря и его работы -->
<script>
// Получение данных о задачах, из нашего PHP-контроллера
const tasksJson = <?= json_encode($tasksJson) ?>;
const tasks = JSON.parse(tasksJson); // tasks это массив объектов
// Преобразование данных (массива) в задачи для календаря
const events = tasks.map((task) => {
    return {
      title: task.title,
      start: new Date(task.created_at), // Используйте created_at вместо start_date
      end: new Date(task.finish_date), // Используйте finish_date вместо end_date
      extendedProps: {
        task_id: task.id, // добавьте ID задачи в расширенные свойства
        },
    };
  });

// Обработчик событий загрузки DOM
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    // Инициализация календаря с настройками
    const calendar = new FullCalendar.Calendar(calendarEl, {
         initialView: 'dayGridMonth',
        
        events: events, // Задачи в виде событий на календаре
        eventClick: function (info) {
            const taskId = info.event.extendedProps.task_id;

            // URL для  адреса страницы конкретной задачи
            const taskUrl = `<?=$path;?>${taskId}`;

            //переход на страницу задачи
            window.location.href = taskUrl;
        },
    });

    calendar.render();
});
</script>

<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();