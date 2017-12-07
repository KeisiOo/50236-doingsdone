<?php

require_once ('functions.php');
require_once ('data.php');
// require_once ('form.php');


$category = [];
$filteredTasks = $tasks;

if (isset($_GET['project_id'])) {
	$category = getCategoryById ($_GET['project_id'], $categories);

	if (!$category) {
		http_response_code (404);
		$category = ['id' => -1, 'name' => 'Не найдено'];
	}

	$filteredTasks = filterTasksByCategory ($category, $tasks);
}

if (isset($_GET['add'])) {
	$add = $_GET['add'];
	require_once ('templates/form.php');
}

$hasOverlay = ($_GET['add'] == 'true');

$newTask = [
	'task' => '',
	'date' => '',
	'category' => -1,
	'done' => false
];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$newTask = $_POST;

	$required = ['name', 'project', 'date'];
	$errors = [];

	foreach ($_POST as $key => $value) {
		if (in_array($key, $required)) {
			if (!$value) {
				$errors[$key] = 'Это поле надо заполнить';
			}
		}
	}

	if (count($errors)) {
		$pageContent = includeTemplate('templates/form.php', ['newTask' => $newTask, 'errors' => $errors]);
	}
}

else {
	// array_unshift($filteredTasks, $newTask);
	$pageContent = includeTemplate ('templates/index.php', [
		'tasks' => $filteredTasks,
		'show_complete_tasks' => $show_complete_tasks,
		'days_until_deadline' => $days_until_deadline
	]);
}

$layoutContent = includeTemplate ('templates/layout.php', [
	'content' => $pageContent,
	'categories' => $categories,
	'tasks' => $tasks,
	'username' => 'Константин',
	'title' => 'Дела в порядке'
]);

print($layoutContent);

?>

