<?php

	/**
	 * @author Gavin Staniforth
	 * @version 1.0, 29th January 2012
	 *
	 * This class allows views to load elements, from their runtime state
	 */		
	class View
	{

		protected $args;

		/**
		 * View class is set with the file and arguments it requires
		 * 
		 * @param string $file
		 * @param array $args 
		 */
		public function __construct($file, array $args=null)
		{

			if ($args !== null) {
				$this->args = $args;
				array_walk($args, 'XSSFilter::filter');

				extract($args);
			}

			require $file;
		}

		/**
		 * Load an element
		 * 
		 * @param string $name
		 */
		public function element($name)
		{
			$file = Bootstrap::getInstance()->getRoot() . 'Application/Elements/' . $name . '.php';

			if (is_readable($file)) {
				if (is_array($this->args)) {
					extract($this->args);
				}
				
				require $file;
			} else {
				throw new ElementException('Element not found - ' . $file);
			}
		}

	}