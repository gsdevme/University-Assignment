<?php

	class XSSFilter
	{

		public static function filter(&$value, $key)
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