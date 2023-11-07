<?php

declare(strict_types=1);

# Показать аналитику по задачам за все время
function reportCommand(array $arguments = [])
{
	$allTodos = prepareReportData();

	// var_dump($allTodos);
	$totalDays = count($allTodos);

	$totalTasksCount = array_reduce($allTodos, function($prev, $todos) {
		return $prev + count($todos);
	}, 0);

	$totalCompletedTasksCount = array_reduce($allTodos, function($prev, $todos) {
		$completed = array_filter($todos, fn($todo) => $todo['completed']);
		return $prev + count($completed);
	}, 0);

	$dailyTaskCounts = array_map(function($todos) {
		return count($todos);
	}, $allTodos);

	$minTasksCount = min($dailyTaskCounts);
	$maxTasksCount = max($dailyTaskCounts);

	$averageTasksCount = 0;
	$averageCompletedTasksCount = 0;

	if ($totalDays > 0)
	{
		$averageTasksCount = floor($totalTasksCount / $totalDays);
		$averageCompletedTasksCount = floor($totalCompletedTasksCount / $totalDays);
	}

	$report  = [
		"Total days: $totalDays",
		"Total tasks: $totalTasksCount",
		"Total completed tasks: $totalCompletedTasksCount",
		"Min tasks in a day: $minTasksCount",
		"Max tasks in a day: $maxTasksCount",
		"Average tasks per day: $averageTasksCount",
		"Average completed tasks per day: $averageCompletedTasksCount"
	];
	echo implode(PHP_EOL, $report). PHP_EOL;
}

function prepareReportData(): array
{
	# Получене списка файлов из определенной директории
	$files = scandir(ROOT . '/data');

	$allTodos = [];

	# Цикл по файлам
	foreach ($files as $file)
	{
		# Выбираем только файлы подходящие по маске названия
		if (!preg_match('/^\d{4}-\d{2}-\d{2}\.txt$/', $file))
		{
			continue;
		}

		# Содержимое файла
		$content = file_get_contents(ROOT . "/data/$file");
		# Параметр options обеспечивает безопасноть
		$todos = unserialize($content, ['allowed_classes' => false]);

		# Проверка на массив
		$todos = is_array($todos) ? $todos : [];

		[$date] = explode('.', $file);

		$allTodos[$date] = $todos;


	}
	return $allTodos;
}