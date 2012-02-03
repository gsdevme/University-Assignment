<?php

	/**
	 * @author Gavin Staniforth
	 * @version 1.0, 3rd Feburary 2012
	 *
	 * This class is an abstract controll for all user defined controllers
	 */	
	abstract class Controller
	{

		protected $bootstrap, $controller, $method;

		/**
		* 
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
		* 
		*
		* @param string $model This is the name of the model
		* @param array $args
		* @return object
		*/
		protected function model($model, array $args=null)
		{
			return Factory::model($model, $args);
		}

		/**
		*
		*
		* @param string $library This is the name of the library
		* @param array $args
		* @return object
		*/
		protected function library($library, array $args=null)
		{
			return Factory::library($library, $args);
		}

		/**
		*/
		protected function view($view, array $args=null)
		{
			return ViewFactory::getInstance()->addView($view, $args);
		}

		protected function render()
		{
			return ViewFactory::getInstance()->render();
		}
		
		protected function route(array $route)
		{
			return ControllerFactory::route($route);
		}

	}