<?php

declare(strict_types=1);

function mapTodos(array $todos, array $position, Closure $callback): array
{
	foreach ($position as $position)
	{
		$index = (int)$position - 1;

		if (!isset($todos[$index]))
		{
			continue;
		}
		$result = $callback($todos[$index]);
		if (is_array($result))
		{
			$todos[$index] = $result;
		}
		else
		{
			unset($todos[$index]);
		}
	}

	# Возвращаем значения и сбрасываем индексы
	return array_values($todos);
}