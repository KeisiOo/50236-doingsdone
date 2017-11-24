 <?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

$days = rand(-3, 3);
$task_deadline_ts = strtotime("+" . $days . " day midnight"); // метка времени даты выполнения задачи
$current_ts = strtotime('now midnight'); // текущая метка времени

// запишите сюда дату выполнения задачи в формате дд.мм.гггг
$date_deadline = date("d.m.Y", $task_deadline_ts);

// в эту переменную запишите кол-во дней до даты задачи
$days_until_deadline = floor(($task_deadline_ts - $current_ts) / 86400);
?>

<h2 class="content__main-heading">Список задач</h2>

<form class="search-form" action="index.html" method="post">
    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

    <input class="search-form__submit" type="submit" name="" value="Искать">
</form>

<div class="tasks-controls">
    <nav class="tasks-switch">
        <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
        <a href="/" class="tasks-switch__item">Повестка дня</a>
        <a href="/" class="tasks-switch__item">Завтра</a>
        <a href="/" class="tasks-switch__item">Просроченные</a>
    </nav>

    <label class="checkbox">
        <a href="/">
            
            <input class="checkbox__input visually-hidden" type="checkbox" <?php if ($show_complete_tasks == 1): ?> checked <?php endif; ?>>
            
            <span class="checkbox__text">Показывать выполненные</span>
        </a>
    </label>
</div>

<table class="tasks">
    <?php foreach ($tasks as $task): ?>
    <tr class="tasks__item task <?php if ($task['done'] == true): ?> task--completed <?php endif; ?> <?php if ($days_until_deadline <= 0): ?> task--important <?php endif; ?>">
        <td class="task__select">
            <label class="checkbox task__checkbox">
                <input class="checkbox__input visually-hidden" type="checkbox">
                <a href="/"><span class="checkbox__text"><?php print($task['task']); ?></span></a>
            </label>
        </td>

        <td class="task__file">
        </td>

        <td class="task__date"><?php print($task['date']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>