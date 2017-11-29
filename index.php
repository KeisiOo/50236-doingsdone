<?php

require_once ('functions.php');
require_once ('data.php');

$project = null;

if (isset($_GET['project_id'])) {
	$project_id = $_GET['project_id'];

	for ($i = 0; $i < count($projects); $i++) {
		if ($projects[$i] == $project_id) {
			$project = $projects[$i];
			break;
		}
	}
}

var_dump($project);

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

