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
       // получение данных о задачах из нашего php контроллера 
        const tasksJson = <?= json_encode($tasksJson);?>
        const tasks = JSON.parse(tasksJson); // парсим содержимое в массив объектов
// преобразование данных(массива) в задачи для календаря
        const events = tasks.map((task) => {
            return {
                title: task.title,
                start: new Date(task.created_at),
                end: new Date(task.finish_date),
                extendProps: {
                    task_id: task.id,    
                },
            };
        });
// обработчки событий загрузки нашего DOM объекта
        document.addEventListener("DOMContentLoaded", function(){
            const calendarE1 = document.getElementById('calendar');
            // инициализация календаря с настройками
            const calendar = new FullCalendar.Calendar(calendarE1, {
                initialView: 'dayGridMonth',
                event: events, // задачи в виде событий на календаре
                eventClick : function(info){
                    const taskId = info.event.extendProps.taskId;
                    // url куда переводить пользователя после клика(стр конкретной задачи)
                    const taskUrl = '<?= $path;?>${taskId}';
                    // переход на страницу задачи
                    window.location.href = taskUrl;

                },
            });
            // запускаем рендер календаря
            calendar.render();
        });
    </script>

<?php $content = ob_get_clean();

include 'app/views/layout.php'; // сюда будет передаваться контент размещенный выше между ob_start(); и $content = ob_get_clean();