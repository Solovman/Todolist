<?php
/**
 * @var array $todos
 * @var bool $isHistory
 * @var array $errors
 */

$url = '/index.php';
?>


<main>
	<?php if (!empty($errors)): ?>
		<div class="alert danger">
			<?= implode('<br>', $errors) ?>
		</div>
	<?php endif; ?>

	<?php if (empty($todos)): ?>
		<p>Noting todo here</p>
	<?php endif; ?>

	<?php foreach ($todos as $todo):?>
		<?= view('components/todo', [
			'todo' =>$todo,
			'isHistory' => $isHistory,
		])?>
	<?php endforeach; ?>


	<?php if (!$isHistory): ?>
		<form action=<?= $url ?> method="post" class="add-todo">
			<input type="text" name="title" placeholder="What to do?">
			<button type="submit">Save</button>
		</form>
	<?php endif; ?>
</main>