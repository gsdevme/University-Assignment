<?php

	/**
	 * @author Gavin Staniforth
	 * @version 1.0, 29th January 2012
	 * This file is loaded by default within the index.php.
	 * 
	 * Its main purpose is to provide global functions across the application
	 */

	/**
	 * This function adds the purposed language construct detailed here
	 * https://wiki.php.net/rfc/ifsetor
	 * 
	 * @param mixed $value
	 * @param mixed $or
	 * @return mixed 
	 */
	function ifsetor(&$value, $or=null)
	{
		return (isset($value)) ? $value : $or;
	}

	/**
	 * This function helps debugging during development
	 */
	function pre()
	{
		echo '<pre>' . print_r(func_get_args(), true) . '</pre>';
	}

	/**
	 * Function which is "pass by reference" and calls isset() & empty()
	 *
	 * @param mixed $value
	 * @return bool 
	 */
	function isValue(&$value)
	{
		return ( bool ) ((isset($value)) && (!empty($value)));
	}

	