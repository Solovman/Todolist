<?php

declare(strict_types=1);

# Добавить пункт в список дел
function addCommand(array $arguments)
{
	$title = array_shift($arguments);

	$todo = [
		'id' => uniqid(),
		'title' => $title,
		'completed' => false,
		'created_at' => time(),
		'update_at' => null,
		'completed_at' => null,
	];

	$todos = getTodos();
	$todos[] = $todo;

	storeTodos($todos);
}