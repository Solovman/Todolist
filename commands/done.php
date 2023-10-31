<?php

declare(strict_types=1);

# Выполнение заметки [X]
function doneCommand(array $arguments)
{
	$todos = getTodosOrFail();

	# Текущее время
	$now = time();

	$todos = mapTodos($todos, $arguments, function($todo) use ($now) {
		return array_merge($todo, [
			'completed' => true,
			'update_at' => $now,
			'complete_at' => $now,
		]);
	});
	#Сохраняем в файл
	storeTodos($todos);
}
