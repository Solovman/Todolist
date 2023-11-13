<?php
/**
 * @var string $title
 * @var string $content
 * @var $bottomMenu
 */
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/public/style.css">
	<title><?= $title ?></title>
</head>
<body>
<section class="content">
	<header>
		<a href="/todolist/public/index.php" class="icon">📝</a>
		<h1><?= $title ?><h1>
	</header>
	<?= $content ?>

	<footer>
		<div>
			&copy;  <?= date('Y') ?> Todolist
		</div>
		<?= view('components/menu', ['items' => $bottomMenu])?>
	</footer>
</section>

</body>
</html>