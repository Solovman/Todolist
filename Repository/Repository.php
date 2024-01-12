<?php

declare(strict_types=1);

namespace Todolist\Repository;
abstract class Repository
{
	abstract public function getList(array $filter): array;

	abstract public function add($entity): bool;

	abstract public function update($entity): bool;

	public function getListOrFail(array $filter = []): array
	{
		$items = $this->getList($filter);

		# Если массив пустой
		if (empty($items))
		{
			echo 'Nothing to do here' . PHP_EOL;
			exit();
		}

		return $items;
	}
}