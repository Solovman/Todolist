<?php

declare(strict_types=1);

//php todo.php list
//php todo.php list 2022-10-31
//php todo.php list yesterday
//php todo.php add "Wake up"
//php todo.php add "Drink coffee"
//php todo.php complete 1 2
//php todo.php remove 2 (re)

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
		case 'complete':
			completeCommand($arguments);
			break;
		case 'remove':
		case 'rm':
			removeCommand($arguments);
			break;
		default:
			echo 'Unknown command';
			exit(1); # Сделаем код ошибки 1
	}
	exit(0); # Выход с 0 - команда завершилась хорошо
}

# Добавить пункт в список дел
function addCommand(array $arguments)
{
	$title = array_shift($arguments);

	$todo = [
		'id' => uniqid(),
		'title' => $title,
		'completed' => false,
	];
	// var_dump($todo);
	$fileName = date('Y-m-d') . '.txt';

	$filePath = __DIR__ . '/data/' . $fileName; # Путь к файлу

	# Проверка файла на существование
	if (file_exists($filePath))
	{
		#Содержимое файла
		$content = file_get_contents($filePath);
		# Параметр options обеспечивает безопасноть
		$todos = unserialize($content, [
			'allowed_classes' => false,
		]);
		$todos[] = $todo;
		file_put_contents($filePath, serialize($todos));
	}
	else # Если файла нет
	{
		$todos = [$todo]; # Мсссив из одного дела
		file_put_contents($filePath, serialize($todos));
	}

}

function removeCommand(array $arguments)
{

}

function completeCommand(array $arguments)
{

}

# Получить список дел
function listCommand(array $arguments)
{
	$fileName = date('Y-m-d') . '.txt';

	$filePath = __DIR__ . '/data/' . $fileName; # Путь к файлу
	# Если файл не существует
	if (!file_exists($filePath))
	{
		echo 'Nothing to do here';

		return;
	}

	$content = file_get_contents($filePath);
	$todos = unserialize($content, [
		'allowed_classes' => false,
	]);

	# Если массив пустой
	if (empty($todos))
	{
		echo 'Nothing to do here';

		return;
	}

	foreach ($todos as $index => $todo)
	{
		echo sprintf(
			"%s. [%s] %s \n",
			($index + 1),
			$todo['completed'] ? 'x' : ' ',
			$todo['title']
		);
	}
}

# $argv - аргументы командной строки
main($argv);