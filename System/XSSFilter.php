<?php

	/**
	 * @author Gavin Staniforth
	 * @version 1.0, 29th January 2012
	 *
	 * This class is used to filter the value for cross site scripting attacks
	 */	
	class XSSFilter
	{

		/**
		 * This method will get the data type and either cast or filter using UTF-8
		 * 
		 * @param mixed $value
		 */
		public static function filter(&$value)
		{
			switch (gettype($value)) {
				case "object":
				case "array":
					array_walk($value, 'XSSFilter::filter');
					break;
				case "string":
					$value = ( string ) htmlspecialchars(htmlentities(trim(($value)), ENT_QUOTES, 'UTF-8', false), ENT_QUOTES, 'UTF-8', false);
					break;
				case "bool":
					$value = ( bool ) $value;
					break;
				default:
					break;
			}
		}

	}