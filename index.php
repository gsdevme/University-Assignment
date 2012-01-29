<?php

	/**
	 * @author Gavin Staniforth
	 * @version 1.0, 29th January 2012
	 *
	 * This MVC Framework was created for use with PHP 5.2.6 due to University servesrs being PHP 5.2.6
	 *
	 * This is the main target or any link, it includes some core configuration files and classes then 
	 * creates an instance of the request & router to kickstart the MVC
	 */
	$root = realpath(dirname(__FILE__)) . '/';

	require_once $root . 'System/Bootstrap.php';
	require_once $root . 'functions.php';

	// Remove variable from memory
	unset($root);

	try {
		$bootstrap = Bootstrap::getInstance()->setupEnvironment()->setupAutoLoader()->configurePaths('~unn_w11025228');
		$bootstrap->addFileLocation('System/');

		$router = new Router(new Request($bootstrap));
		$router->route($router->getRoute());
	} catch (Exception $e) {
		pre($e);
	}