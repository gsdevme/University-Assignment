<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 29th January 2012
	 * 
	 * 
	 * This file was needed for the creatia, its loaded within index.php and its values 
	 * added to the bootstrap then its removed
	 */
	$PDOConnection = ( object ) array(
			'dns' => 'mysql:dbname=test;host=127.0.0.1',
			'user' => 'root',
			'pass' => 'lemonSticks'
	);