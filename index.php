<?php
	/**
	* @author Gavin Staniforth
	* @version 1.0, 29th January 2012
	* This MVC Framework was created for use with PHP 5.2.6.
	*
	* This is the main target or any link, it includes some core configuration files and classes then 
	* creates an instance of the request & router to kickstart the MVC
	*/

	require_once './bootstrap.php';

	$bootstrap = Bootstrap::getInstance()->setupEnvironment()->setupAutoLoader()->configurePaths('~unn_w11025228');
	$root = $bootstrap->getRoot();

	require_once $root . 'functions.php';

	// Remove variable from memory
	unset($root);

	try{
		new System_Router(new System_Request($bootstrap));		
	}catch(Exception $e){
		pre($e);
	}