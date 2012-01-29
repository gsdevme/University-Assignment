<?php

	abstract class Controller
	{

		protected $bootstrap;

		public function __construct(Bootstrap $bootstrap)
		{
			$this->bootstrap = $bootstrap;
		}

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