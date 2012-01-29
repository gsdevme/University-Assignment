<?php

	class Router
	{

		private $_route;
		private $_defaultController;
		private $_defaultMethod;

		/**
		 *
		 * @param Request $request 
		 */
		public function __construct(Request $request)
		{
			$this->_defaultController = 'home';
			$this->_defaultMethod = 'index';

			$this->_route = ($request->getRequest() !== null) ? explode('/', $request->getRequest()) : array($this->_defaultController, $this->_defaultMethod);
			
			if(count($this->_route) < 2){
				array_push($this->_route, $this->_defaultMethod);
			}
		}

		public function getRoute()
		{
			return ( array ) $this->_route;
		}

	}