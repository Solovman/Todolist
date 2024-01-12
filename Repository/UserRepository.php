<?php

declare(strict_types=1);

namespace Todolist\Repository;

class UserRepository extends Repository
{
	/**
	 * @param array $filter
	 *
	 * @return User[]
	 */

	public function getList(array $filter = []): array
	{
		// SELECT * FORM user
		return [];
	}

	public function add($user): bool
	{
		// INSERT INTO user
		return true;
	}

	public function update($user): bool
	{
		// UPDATE user SET VALUES (...)
		return true;
	}
}