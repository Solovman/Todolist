<?php
/**
 * @var Todo $todo
 * @var bool $isHistory
 */


$createdAt = $todo->getCreatedAt();

?>
<article class="todo">
	<label>
		<input
			type="checkbox"
			<?= ($todo->isCompleted()) ? 'checked': ''?>
			<?= ($isHistory) ? 'disabled': ''?>
		>
		<?= safe(truncate($todo->getTitle(), option('TRUNCATE_TODO', 200))) ?>

		<time datetime="<?= $createdAt->format(DateTime::ATOM)?>">
			<?= $createdAt->format('M, d') ?>
		</time>
	</label>
</article>