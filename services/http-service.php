<?php

declare(strict_types=1);

function redirect(string $url)
{
	header("Location: $url");
}