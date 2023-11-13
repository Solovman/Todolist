<?php

declare(strict_types=1);

$bottomMenu = [];

$time = isset($_GET['date']) ? strtotime($_GET['date']) : time();
if ($time === false)
{
	$time = time();
}
$secondsInDay = (60 * 60 * 24);
$dayBefore = $time - $secondsInDay;
$dayAfter = $time + $secondsInDay;

return [
	['url' => '/todolist/public/index.php?date=' . date('Y-m-d', $dayBefore), 'text' => '-1 day'],
	['url' => '/todolist/public/index.php?date='. date('Y-m-d', $dayAfter), 'text' => '+1 day'],
	['url' => '/todolist/public/index.php', 'text' => 'Today'],
	['url' => '/todolist/public/report.php', 'text' => 'Reporting'],
];
