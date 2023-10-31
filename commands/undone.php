<?php

declare(strict_types=1);

# Снятие выполнения заметки [ ]
function undoneCommand(array $arguments)
{
	$todos = getTodosOrFail();

	$todos = mapTodos($todos, $arguments, function($todo) {
		return array_merge($todo, [
			'completed' => false,
			'update_at' => time(),
			'complete_at' => null,
		]);
	});

	#Сохраняем в файл
	storeTodos($todos);
}
