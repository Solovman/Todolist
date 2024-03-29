<?php

declare(strict_types=1);

namespace Todolist\Repository;

use Todo,
	DateTime,
	Exception;
class TodoRepository extends Repository
{
	/**
	 * @param array $filter
	 *
	 * @return Todo[]
	 */

	public function getList(array $filter = []): array
	{
		$time = $filter['time'] ?? time();
		$connection = getDbConnection();

		$from = date('Y-m-d 00:00:00', $time);
		$to = date('Y-m-d 23:59:59', $time);

		$result = mysqli_query(
			$connection,
			"
	SELECT * FROM todos
	WHERE created_at BETWEEN '{$from}' AND '{$to}'
	ORDER BY created_at
	LIMIT 100
	"
		);

		if (!$result)
		{
			throw new Exception(mysqli_error($connection));
		}

		$todos = [];

		while ($row = mysqli_fetch_assoc($result))
		{
			$todos[] = new Todo(
				$row['title'],
				$row['id'],
				($row['completed'] === 'Y'),
				new DateTime($row['created_at']),
				$row['updated_at'] ? new DateTime($row['updated_at']) : null,
				$row['completed_at'] ? new DateTime($row['completed_at']) : null,

			);
		}

		return $todos;
	}

	/**
	 * @param Todo $todo
	 * @return bool
	 * @throws Exception
	 */
	public function add($todo): bool
	{
		$connection = getDbConnection();

		$id = mysqli_real_escape_string($connection, $todo->getId());
		$title = mysqli_real_escape_string($connection, $todo->getTitle());
		$completed = $todo->isCompleted() ? 'Y' : 'N';
		$createdAt = $todo->getCreatedAt()->format('Y-m-d:H:i:s');
		$completedAt = $todo->getCompletedAt() ? $todo->getCompletedAt()->format('Y-m-d:H:i:s') : null;
		$updatedAt = $todo->getUpdatedAt() ? $todo->getUpdatedAt()->format('Y-m-d:H:i:s') : null;

		$completedAt = $completedAt ? "'{$completedAt}'" : "NULL";
		$updatedAt = $updatedAt ? "'{$updatedAt}'" : "NULL";

		$sql = "INSERT INTO todos (id, title, completed, created_at, updated_at, completed_at) VALUES (
    '{$id}', 
    '{$title}',
    '{$completed}',
    '{$createdAt}',
    {$completedAt},
    {$updatedAt});";

		$result = mysqli_query($connection, $sql);
		if (!$result)
		{
			throw new Exception(mysqli_error($connection));
		}

		return true;
	}

	public function update($todo): bool
	{
		// UPDATE user SET VALUES (...)
		return true;
	}
}