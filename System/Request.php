<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
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
			$request = $bootstrap->getServerParam('request_uri');
			$file = $bootstrap->getServerParam('script_name');

			if (isValue($request)) {
				$request = substr(str_replace($file, null, $request), 1);

				// Remove Numyspace ID if any
				$request = ($bootstrap->isNumyspace()) ? str_replace($bootstrap->getNumyspaceId(), null, $request) : $request;

				$request = $this->_clean($request);

				// If its still a value
				if (isValue($request)) {
					$this->_request = $request;
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