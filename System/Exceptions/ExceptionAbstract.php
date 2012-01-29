<?php

	abstract class ExceptionAbstract extends Exception
	{

		private $_previous;

		public function __construct($message, $code, Exception $previous=null)
		{
			$this->_previous = $previous;

			parent::__construct($message, $code);
		}

		/**
		 * This method adds a method that is already within PHP 5.3 just missing from PHP 5.2.x
		 * 
		 * @param Exception 
		 */
		public function getPrevious()
		{
			return $this->_previous;
		}
	}