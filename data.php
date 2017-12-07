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



$categories = [
	[
		'id' => 0,
		'name' => 'Все'
	],
	[
		'id' => 1,
		'name' => 'Входящие'
	],
	[
		'id' => 2,
		'name' => 'Учеба'
	],
	[
		'id' => 3,
		'name' => 'Работа'
	],
	[
		'id' => 4,
		'name' => 'Домашние дела'
	],
	[
		'id' => 5,
		'name' => 'Авто'
	]
];
	
$tasks = [
	[
		'task' => 'Собеседование в IT компании',
		'date' => '01.06.2018',
		'category' => 3,
		'done' => false
	],
	[
		'task' => 'Выполнить тестовое задание',
		'date' => '25.05.2018',
		'category' => 3,
		'done' => false
	],
		[
		'task' => 'Сделать задание первого раздела',
		'date' => '21.04.2018',
		'category' => 2,
		'done' => true
	],
		[
		'task' => 'Встреча с другом',
		'date' => '22.04.2018',
		'category' => 1,
		'done' => false
	],
		[
		'task' => 'Купить корм для кота',
		'date' => '',
		'category' => 4,
		'done' => false
	],
		[
		'task' => 'Заказать пиццу',
		'date' => '',
		'category' => 4,
		'done' => false
	],
];
