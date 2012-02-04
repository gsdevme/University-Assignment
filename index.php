<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 29th January 2012
	 *
	 * This MVC Framework was created for use with PHP 5.2.6 due to University servers being PHP 5.2.6
	 *
	 * The Framework was adapted from my PHP 5.3.3+ framework named Panda. http://gsdev.me/
	 *
	 * This is the main target or any link, it includes some core configuration files and classes then 
	 * creates an instance of the request & router to kickstart the MVC
	 */
	$root = realpath(dirname(__FILE__)) . '/';
	$debug = true;

	require_once $root . 'functions.php';
	require_once $root . 'connectionDetails.php';
	require_once $root . 'System/Exceptions/ExceptionAbstract.php';
	require_once $root . 'System/Bootstrap.php';

	// Remove variable from memory
	unset($root);

	try {
		// Lets setup the environment for server/local then setup an autoloader and load configurations
		$bootstrap = Bootstrap::getInstance($_SERVER)
			->setupEnvironment()
			->setupAutoLoader()
			->setPDOConnectionDetails($PDOConnection)
			->setErrorException()
			->configurePaths('~unn_w11025228');

		// Remove variable from memory
		unset($PDOConnection);
		unset($_SERVER);
		unset($_ENV);

		// Lets add the locations to our bootstrap
		$bootstrap->addFileLocation('System/')
			->addFileLocation('System/Exceptions/')
			->addFileLocation('Application/Controllers/')
			->addFileLocation('Application/Models/');

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

		if($debug !== true){
			switch($e->getCode() ){
				case 404:
					ControllerFactory::notFound(array($e));
					exit;
				default:
					die('Woops');
					exit;
			}
		}

		ControllerFactory::route(array('error', 'index', $e));
	}
	
	