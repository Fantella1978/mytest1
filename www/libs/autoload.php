<?php

spl_autoload_register(function ($class)
{
	$classFileName = $class . '.php';
	
	if (file_exists(__DIR__ . '/controllers/' . $classFileName)) {
		require __DIR__ . '/controllers/' . $classFileName;
	} elseif (file_exists(__DIR__ . '/classes/' . $classFileName)) {
		require __DIR__ . '/classes/' . $classFileName;
	} elseif (file_exists(__DIR__ . '/models/' . $classFileName)) {
		require __DIR__ . '/models/' . $classFileName;
	} elseif (file_exists(__DIR__ . '/views/' . $classFileName)) {
		require __DIR__ . '/views/' . $classFileName;
	} else {
		echo 'Can`t find ' . $classFileName . 'DIE';
		die;
	}
});
?>