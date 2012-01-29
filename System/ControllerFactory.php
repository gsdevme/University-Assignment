<?php

	class ControllerFactory
	{

		/**
		 *
		 * @param array $route 
		 */
		public static function route(array $route)
		{
			$controller = ucfirst(array_shift($route));

			try {
				$class = new ReflectionClass($controller);
				$method = new ReflectionMethod($controller, ucfirst(array_shift($route)));

				$method->invoke($class->newInstance(), null);
			} catch (ClassNotFoundException $e) {
				pre($e);
			}
		}

	}