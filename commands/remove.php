<?php

declare(strict_types=1);

function removeCommand(array $arguments)
{
	# Получаем полный список дел
	$todos = getTodosOrFail();

	$todos = mapTodos($todos, $arguments, fn($todo) => null);

	#Сохраняем в файл
	storeTodos($todos);

}