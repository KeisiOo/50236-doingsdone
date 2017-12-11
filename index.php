<?php

require_once('app/init.php');


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

function getForm ($categories, $tasks) {
    $newTask = [
        'task' => '',
        'date' => '',
        'category' => -1,
        'done' => false
    ];

    if ($_SERVER['REQUEST_METHOD'] != 'POST' && isset($_GET['add']) && $_GET['add'] == 'true') {
        return [includeTemplate ('templates/form.php', [
            'newTask' => $newTask,
            'errors' => [],
            'categories' => $categories]), true, $tasks
    	];
    }

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        return ['', false, $tasks];
    }

    $required = ['task', 'category', 'date'];
    $errors = [];

	foreach ($_POST as $key => $value) {
		if (in_array($key, $required)) {
			if (!$value) {
				$errors[$key] = 'Это поле надо заполнить';
			}
		}
	}

    if ($_POST['category'] == -1) {
        $errors['category'] = "Выберите значение";
    }

    $newTask['task'] = $_POST['task'];
    $newTask['date'] = $_POST['date'];
    $newTask['category'] = $_POST['category'];

    if ($_FILES['preview']['name']) {
        $uploadFile = $_SERVER['DOCUMENT_ROOT'] . basename($_FILES['preview']['name']);
        if (!move_uploaded_file($_FILES['preview']['tmp_name'], $uploadFile)) {
            $errors['preview'] = "Возможная атака с помощью файловой загрузки!";
        }
    }

    if (count($errors)) {
        return [ includeTemplate('templates/form.php', [
            'newTask' => $newTask,
            'errors' => $errors,
            'categories' => $categories]), true, $tasks 
   		];
    }

    array_unshift($tasks, $newTask);
    return ['', false, $tasks];
}

list($form, $showForm, $filteredTasks) = getForm ($categories, $filteredTasks);

function getUser ($users) {
    $authUser = [
        'email' => '',
        'password' => '',
    ];

    if ($_SERVER['REQUEST_METHOD'] != 'POST' && isset($_GET['auth']) && $_GET['auth'] == 'true') {
        return [includeTemplate ('templates/auth_form.php', [
            'authUser' => $authUser,
            'errors' => [],
            'users' => $users]), true
        ];
    }

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        return '';
    }

    $required = ['email', 'password'];
    $errors = [];

    foreach ($_POST as $key => $value) {
        if (in_array($key, $required)) {
            if (!$value) {
                $errors[$key] = 'Это поле надо заполнить';
            }
        }
    }

    $authUser['email'] = $_POST['email'];
    $authUser['password'] = $_POST['password'];

    if ($user = searchUserByEmail($authUser['email'], $users)) {
        if (password_verify($authUser['password'], $user['password'])) {
            $_SESSION['user'] = $user;
        }
        else {
            $errors['password'] = 'Неверный пароль';
        }
    }
    else {
        $errors['email'] = 'Такой пользователь не найден';
    }

    if (count($errors)) {
        return [includeTemplate('templates/auth_form.php', [
            'authUser' => $authUser,
            'errors' => $errors,
            'users' => $users]), true
        ];
    }

    return ''; 
}

list($form, $showForm, $filteredTasks) = getUser($users);

$pageContent = includeTemplate ('templates/index.php', [
    'tasks' => $filteredTasks,
    'show_complete_tasks' => $show_complete_tasks,
    'days_until_deadline' => $days_until_deadline
]);

$guest = includeTemplate('templates/guest.php', []);

$layoutContent = includeTemplate ('templates/layout.php', [
    'form' => $form,
	'content' => $guest,
	'categories' => $categories,
	'tasks' => $tasks,
	'username' => 'Константин',
	'title' => 'Дела в порядке',
    'hasOverlay' => $showForm
]);

print($layoutContent);

