<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 3rd Feburary 2012
	 *
	 * This class is an abstract controll for all user defined controllers
	 */	
	abstract class Controller
	{

		protected $bootstrap, $controller, $method;

		/**
		* Assigns some useful information into the controller for use later in the app
		*
		* @param Bootstrap $bootstrap
		* @param string $controller
		* @param string $method
		*/
		public function __construct(Bootstrap $bootstrap, $controller, $method)
		{
			$this->bootstrap = $bootstrap;
			$this->controller = $controller;
			$this->method = $method;
		}

		/**
		* Used as a shortcut to add a view to the ViewFactory
		* 
		* @param string $view this is the name of the view
		* @param array $args this is any arguments you wish to send to the view
		* @return ViewFactory it returns a ViewFactory object so you can chain the methods
		*/
		protected function view($view, array $args=null)
		{
			return ViewFactory::getInstance()->addView($view, $args);
		}

		/**
		* Used as a shortcut to render all views within the ViewFactory
		* 
		* @return bool returns true once its completed and no errors etc
		*/
		protected function render()
		{
			return ViewFactory::getInstance()->render();
		}
		
		protected function route(array $route)
		{
			return ControllerFactory::route($route);
		}

	}