<?php

declare(strict_types=1);

# Добавить пункт в список дел
function addCommand(array $arguments)
{
	$title = array_shift($arguments);

	$todo = createTodo($title);

	saveTodo($todo);
}