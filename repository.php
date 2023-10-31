<?php

declare(strict_types=1);

/*
 * Паттерн репозиторий
 * Сохраняем данные в файл и получаем данные из файла
*/
function getTodos(?int $time = null): array
{
	$filePath = getRepositoryPath($time);

	# Если файл не существует
	if (!file_exists($filePath))
	{
		return [];
	}

	# Содержимое файла
	$content = file_get_contents($filePath);
	# Параметр options обеспечивает безопасноть
	$todos = unserialize($content, [
		'allowed_classes' => false,
	]);

	# Возращаем только в том случае, если массив, иначе возвращаем пустой массив
	return is_array($todos) ? $todos : [];
}

function getTodosOrFail(?int $time = null): array
{
	$todos = getTodos($time);

	# Если массив пустой
	if (empty($todos))
	{
		echo 'Nothing to do here' . PHP_EOL;
		exit();
	}

	return $todos;
}

function storeTodos(array $todos, ?int $time = null)
{
	$filePath = getRepositoryPath($time);
	file_put_contents($filePath, serialize($todos));
}

function getRepositoryPath(?int $time): string
{
	# Если никакое время не передано, то по умолчнию берем текущее
	$time = $time ?? time();

	$fileName = date('Y-m-d', $time) . '.txt';

	return ROOT . '/data/' . $fileName; # Путь к файлу
}