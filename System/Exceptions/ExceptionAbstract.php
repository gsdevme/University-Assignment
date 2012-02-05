<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 29th January 2012
	 *
	 * This class is an abstract exception
	 */
	abstract class ExceptionAbstract extends Exception
	{

		private $_previous;

		/**
		 * Matches the PHP 5.3 consturct while saving allowing previous exception within PHP 5.2
		 * 
		 * @param string $message
		 * @param int $code
		 * @param Exception $previous
		 */
		public function __construct($message, $code=0, Exception $previous=null)
		{
			$this->_previous = $previous;

			parent::__construct($message, $code);
		}

		/**
		 * This method adds a method that is already within PHP 5.3 just missing from PHP 5.2.x
		 * 
		 * @return Exception 
		 */
		public function getPreviousException()
		{
			return $this->_previous;
		}

	}