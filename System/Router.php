<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 29th January 2012
	 *
	 * This is file is used to assign the default Controller/Method.
	 * It then checks against a null request
	 * 
	 */
	class Router
	{

		private $_route, $_defaultController, $_defaultMethod;

		/**
		 * Explodes and sets up the route array
		 * 
		 * @param Request $request 
		 */
		public function __construct(Request $request)
		{
			$this->_defaultController = 'home';
			$this->_defaultMethod = 'index';

			// If there is no request parameter, else assign
			$this->_route = ($request->getRequest() !== null) ? explode('/', $request->getRequest()) : array($this->_defaultController, $this->_defaultMethod);

			// If no method is within the request
			if (count($this->_route) < 2) {
				array_push($this->_route, $this->_defaultMethod);
			}

			array_walk($this->_route, array($this, '_urldecode'));
		}

		/**
		 * Common sense
		 * 
		 * @return array  
		 */
		public function getRoute()
		{
			return ( array ) $this->_route;
		}

		/**
		 * This method will call urldecode upon the value.. 
		 *
		 * @static
		 * @param string $value This is urlenoded string
		 * @return string
		 */
		private static function _urldecode($value)
		{
			return urldecode($value);
		}

	}