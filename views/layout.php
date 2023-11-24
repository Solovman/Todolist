<?php
/**
 * @var string $title
 * @var string $content
 * @var $bottomMenu
 */
?>

<!doctype html>
<html lang=<?= option('APP_LANG', 'en') ?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/style.css">
	<link rel="shortcut icon" href="/assets/todolist-icon.png"/>
	<title><?= $title ?></title>
</head>
<body>
<section class="content">
	<header>
		<a href="/index.php" class="icon">📝</a>
		<h1><?= $title ?><h1>
	</header>
	<?= $content ?>

	<footer>
		<div>
			&copy;  <?= date('Y') .' '. $title?>
		</div>
		<?= view('components/menu', ['items' => $bottomMenu])?>
	</footer>
</section>

</body>
</html>