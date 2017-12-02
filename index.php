<?php

require_once ('functions.php');
require_once ('data.php');

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

$pageContent = includeTemplate ('templates/index.php', [
	'tasks' => $filteredTasks,
	'show_complete_tasks' => $show_complete_tasks,
	'days_until_deadline' => $days_until_deadline
]);

$layoutContent = includeTemplate ('templates/layout.php', [
	'content' => $pageContent,
	'categories' => $categories,
	'tasks' => $tasks,
	'username' => 'Константин',
	'title' => 'Дела в порядке'
]);

print($layoutContent);

?>

