<?php

declare(strict_types=1);

class Todo
{
	private string $id ;

	private string $title;

	private bool $completed = false;

	private DateTime $createdAt;

	private ?DateTime $updatedAt = null;

	private ?DateTime $completedAt = null;

	public function __construct(
		string $title,
		?string $id = null,
		?bool $completed = null,
		?DateTime $createdAt = null,
		?DateTime $updatedAt = null,
		?DateTime $completedAt = null
	)
	{
		$this->id = $id ?? uniqid();
		$this->completed = $completed ?? false;
		$this->createdAt = $createdAt ?? new DateTime();
		$this->updatedAt = $updatedAt;
		$this->completedAt = $completedAt;

		$this->setTitle($title);
	}

	public function getId(): string
	{
		return $this->id;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function setTitle(string $title): void
	{
		$title = trim($title);

		if (strlen($title) === 0)
		{
			throw new Exception('Tittle cannot be empty');
		}
		$this->title = $title;
	}

	public function isCompleted(): bool
	{
		return $this->completed;
	}

	public function setCompleted(bool $completed): void
	{
		$this->completed = $completed;
	}

	public function getCreatedAt(): DateTime
	{
		return $this->createdAt;
	}

	public function getUpdatedAt(): ?DateTime
	{
		return $this->updatedAt;
	}

	public function getCompletedAt(): ?DateTime
	{
		return $this->completedAt;
	}

	public function done(): void
	{
		$now = new DateTime();

		$this->completed = true;
		$this->completedAt = $now;
		$this->updatedAt = $now;
	}

	public function undone(): void
	{
		$this->completed = false;
		$this->completedAt = null;
		$this->updatedAt = new DateTime();
	}
}