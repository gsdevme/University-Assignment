<?php

	/**
	 *
	 * ( \/ ) /  \(    \(  __)(  )     ___   / )( \(  )(  __)/ )( \   ___    / __)/  \ (  ( \(_  _)(  _ \ /  \ (  )  (  )  (  __)(  _ \
	 * / \/ \(  O )) D ( ) _) / (_/\  (___)  \ \/ / )(  ) _) \ /\ /  (___)  ( (__(  O )/    /  )(   )   /(  O )/ (_/\/ (_/\ ) _)  )   /
	 * \_)(_/ \__/(____/(____)\____/          \__/ (__)(____)(_/\_)          \___)\__/ \_)__) (__) (__\_) \__/ \____/\____/(____)(__\_)
	 * 
	 * MVC Song: http://www.youtube.com/watch?v=YYvOGPMLVDo
	 *
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 29th January 2012
	 *
	 * This MVC Framework was created for use with PHP 5.2.6 due to University servers being PHP 5.2.6
	 *
	 * The Framework was adapted from my PHP 5.3.3+ framework named GiantPanda. https://github.com/gsdevme/GiantPanda
	 *
	 * This is the main target or any link, it includes some core configuration files and classes then 
	 * creates an instance of the request & router to kickstart the MVC
	 */
	$root = realpath(dirname(__FILE__)) . '/';
	$debug = false;

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
			->addFileLocation('Application/Models/')
			->addFileLocation('Application/Libraries/')
			->addFileLocation('Application/Structures/');

		// Lets get our route from REQUEST_URI
		$router = new Router(new Request($bootstrap));

		// Ok lets load it !!!!
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

		// Since we might need to load another view & another view data
		ViewFactory::deleteInstance();

		if ($debug !== true) {
			ControllerFactory::notFound(array($e));
			exit(0);
		}

		ControllerFactory::route(array('error', 'index', $e));
	}
	
	