<?php

function option(string $name, $defaultValue = null)
{
	/**@var array $config */
	static $config = null;

	if ($config === null)
	{
		$masterConfig =  require_once ROOT . '/config.php';
		if (file_exists(ROOT . '/local-config.php'))
		{
			$localConfig = require_once ROOT . '/local-config.php';
		}
		else
		{
			$localConfig = [];
		}

		$config = array_merge($masterConfig, $localConfig);
	}

	if (array_key_exists($name, $config))
	{
		return $config[$name];
	}

	if ($defaultValue !== null)
	{
		return $defaultValue;
	}

	throw new Exception("Configuration option {$name} not found");
}