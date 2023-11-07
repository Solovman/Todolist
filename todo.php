<?php

declare(strict_types=1);

//php todo.php list
//php todo.php list 2022-10-31
//php todo.php list yesterday
//php todo.php add "Wake up"
//php todo.php add "Drink coffee"
//php todo.php done 1 2 [X]
//php todo.php undone 1 2 [ ]
//php todo.php remove 2 (re)
//php todo.php report

require_once __DIR__. '/boot.php';

#Точка входа в приложение
function main(array $arguments): void
{
	# Удаляем первый элемент при этом сдвигая индекс (Имя файла не нам не нужно)
	array_shift($arguments);
	$command = array_shift($arguments); # Также она возвращает выброшенное значение

	switch ($command)
	{
		# Реализации для каждой команды выносим в отдельные функции
		case 'list':
			listCommand($arguments);
			break;
		case 'add':
			addCommand($arguments);
			break;
		case 'done':
			doneCommand($arguments);
			break;
			break;
		case 'undone':
			undoneCommand($arguments);
			break;
		case 'remove':
		case 'rm':
			removeCommand($arguments);
			break;
		case 'report':
			reportCommand($arguments);
			break;
		default:
			echo 'Unknown command';
			exit(1); # Сделаем код ошибки 1
	}
	exit(0); # Выход с 0 - команда завершилась хорошо
}

# $argv - аргументы командной строки
main($argv);