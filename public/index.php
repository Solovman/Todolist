<?php

require_once __DIR__ . '/../boot.php';

echo view('layout',[
	'title' => 'Todolist',
	'content' => view('pages/index', [
		'todos' => getTodos(),
		]),
]);

