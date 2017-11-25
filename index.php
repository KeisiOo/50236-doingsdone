<?php

require_once ('functions.php');
require_once ('data.php');

$pageContent = includeTemplate('templates/index.php', [
	'tasks' => $tasks,
	'show_complete_tasks' => $show_complete_tasks,
	'days_until_deadline' => $days_until_deadline
]);

$layoutContent = includeTemplate('templates/layout.php', [
	'content' => $pageContent,
	'projects' => $projects,
	'tasks' => $tasks,
	'username' => 'Константин',
	'title' => 'Дела в порядке'
]);

print($layoutContent);

?>

