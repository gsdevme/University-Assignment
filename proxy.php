<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 29th January 2012
	 *
	 * This is used because an ajax request http://www.numyspace.co.uk/~cgel1/holidays/ 
	 * wouldn't be possible due to cross site scripting, so we need to proxy it through this
	 */	

	$root = realpath(dirname(__FILE__)) . '/';

	require_once $root . 'System/Bootstrap.php';
	require_once $root . 'functions.php';

	// Lets setup the environment for server/local then setup an autoloader and load configurations
	$bootstrap = Bootstrap::getInstance($_SERVER)
		->setupEnvironment()
		->setupAutoLoader()
		->setErrorException()
		->configurePaths('~unn_w11025228');

	// Remove variable from memory
	unset($PDOConnection);
	unset($_SERVER);
	unset($_ENV);

	// Lets add the locations to our bootstrap
	$bootstrap->addFileLocation('System/')
		->addFileLocation('Application/Libraries/');

	if((isset($_GET['url'])) && (!empty($_GET['url']))){
		echo ProxyCurl::get($_GET['url']);
		exit;		
	}
