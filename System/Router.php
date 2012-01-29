<?php

	class Router
	{

		private $_route;
		private $_defaultController;
		private $_defaultMethod;

		
		public function __construct(Request $request)
		{
			$this->_defaultController = 'home';
			$this->_defaultMethod = 'index';

			$this->_route = ($request->getRequest() !== null) ? explode('/', $request->getRequest()) : array($this->_defaultController, $this->_defaultMethod);

			pre($this);
		}

		public static function route(array $route)
		{
			
		}


	}