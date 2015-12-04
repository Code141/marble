<?php
session_start();

require_once('core/config.php');
require_once(CORE_PATH.'route.php');
require_once(CORE_PATH.'controller.php');
require_once(CORE_PATH.'loader.php');
require_once(CORE_PATH.'model.php');
require_once(CORE_PATH.'secu.php');

if (!isset($_SESSION['user']) && $controller != $defaultController) {
	session_destroy();
	header('location:'.SITE_ROOT);
}else if (isset($_SESSION['user']) && $controller == $defaultController && $action != 'logout') {
	header('location:'.SITE_ROOT.'marble/');
}else{
	define('ACTION', $action);
	define('CONTROLLER', $controller);

	require_once(APP_PATH.'controllers/'.$controller.'.php');
	$targetController = new $controller;
	$targetController->$action($params);
}

?>