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