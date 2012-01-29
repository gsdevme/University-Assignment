<?php

	/**
	 * @author Gavin Staniforth
	 * @version 1.0, 29th January 2012
	 *
	 * This MVC Framework was created for use with PHP 5.2.6 due to University servers being PHP 5.2.6
	 *
	 * This is the main target or any link, it includes some core configuration files and classes then 
	 * creates an instance of the request & router to kickstart the MVC
	 */
	$root = realpath(dirname(__FILE__)) . '/';

	require_once $root . 'functions.php';
	require_once $root . 'System/Exceptions/ExceptionAbstract.php';
	require_once $root . 'System/Bootstrap.php';

	// Remove variable from memory
	unset($root);

	try {
		// Lets setup the environment for server/local then setup an autoloader and load configurations
		$bootstrap = Bootstrap::getInstance()->setupEnvironment()->setupAutoLoader()->configurePaths('~unn_w11025228');

		// Lets add the locations to our bootstrap
		$bootstrap->addFileLocation('System/');
		$bootstrap->addFileLocation('System/Exceptions/');
		$bootstrap->addFileLocation('Application/Controllers/');

		$router = new Router(new Request($bootstrap));

		ControllerFactory::route($router->getRoute());

		// Remove variable from memory
		unset($router);
		unset($bootstrap);
	} catch (Exception $e) {
		$obStatus = ob_get_status();

		if (!empty($obStatus)) {
			// Remove anything from the buffer
			if (ob_get_length() > 0) {
				ob_end_clean();
			}
		}

		if ($e->getCode() == 404) {
			ControllerFactory::notFound(array($e));
			exit;
		}

		ControllerFactory::route(array('error', 'index', $e));
	}
	