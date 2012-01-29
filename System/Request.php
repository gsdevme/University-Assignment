<?php

	/**
	 * @author Gavin Staniforth
	 * @version 1.0, 29th January 2012
	 *
	 * This is file is used to parse the request_uri
	 */
	class Request
	{

		private $_request;

		/**
		 * Checks if the request_uri has a value, then performs str_replace(), substr(),
		 * cleans it before assigning to $_request
		 *
		 * @param Bootstrap $bootstrap 
		 */
		public function __construct(Bootstrap $bootstrap)
		{
			if (isValue($_SERVER['REQUEST_URI'])) {
				$_SERVER['REQUEST_URI'] = substr(str_replace($_SERVER['SCRIPT_NAME'], null, $_SERVER['REQUEST_URI']), 1);

				// Remove Numyspace ID if any
				$_SERVER['REQUEST_URI'] = ($bootstrap->isNumyspace()) ? str_replace($bootstrap->getNumyspaceId(), null, $_SERVER['REQUEST_URI']) : $_SERVER['REQUEST_URI'];

				$_SERVER['REQUEST_URI'] = $this->_clean($_SERVER['REQUEST_URI']);

				// If its still a value
				if (isValue($_SERVER['REQUEST_URI'])) {
					$this->_request = $_SERVER['REQUEST_URI'];
				}
			}
		}

		/**
		 * Common sense
		 *
		 * @return string 
		 */
		public function getRequest()
		{
			return $this->_request;
		}

		/**
		 * Cleans the request string, removes any / from the string
		 *
		 * @param string $value request string
		 * @return string 
		 */
		private function _clean($value)
		{
			// Remove / Prefix
			if (substr($value, 0, 1) == '/') {
				$value = substr($value, 1);
			}

			// Remove / Suffix
			if (substr($value, strlen($value) - 1, 1) == '/') {
				$value = substr($value, 0, strlen($value) - 1);
			}
			return $value;
		}

	}