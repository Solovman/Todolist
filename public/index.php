<?php

declare(strict_types=1);
// echo '<pre>',var_dump($_GET); die; '</pre>';

require_once __DIR__ . '/../boot.php';

$time = null;
$isHistory = false;
$title = option('APP_NAME', 'Todolist');
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$title = trim($_POST['title']);

	if (strlen($title) > 0)
	{
		$todo = createTodo($title);

		addTodo($todo);

		redirect('/index.php/?saved=true');
	}
	else
	{
		$errors[] = 'Task cannot be empty';
	}
}

if (isset($_GET['date']))
{
	$time = strtotime($_GET['date']);
	if($time === false)
	{
		$time = time();
	}
	$today = date('Y-m-d');

	if ($today !== date('Y-m-d', $time))
	{
		$isHistory = true;
		$title = sprintf('Todolist :: %s', date('j M', $time));
	}
}

echo view('layout',[
	'title' => $title,
	'bottomMenu' => require_once ROOT . '/menu.php',
	'content' => view('pages/index', [
		'todos' => getTodos($time),
		'isHistory' => $isHistory,
		'errors' => $errors,
		]),
]);

