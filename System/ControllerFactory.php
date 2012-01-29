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
				$method = new ReflectionMethod($controller, array_shift($route));

				if (($method->isPublic()) && ($class->isInstantiable())) {
					// is there any arguments ?					
					if ((count($route) == 0) && ($method->getNumberOfRequiredParameters() == 0)) {
						return $method->invoke($class->newInstance(Bootstrap::getInstance()), null);
					}

					// are we sending the correct amount of parameters ?
					if (count($route) >= $method->getNumberOfRequiredParameters()) {
						return $method->invokeArgs($class->newInstance(Bootstrap::getInstance()), $route);
					}

					throw new RouterException('The controller method was not sent the correct amount of parameters', 404);
				}

				throw new RouterException('The method is either not public or the class is not isInstantiable', 404);
			} catch (ClassNotFoundException $e) {
				// catch it for Line 37
			}

			throw new RouterException('The controller/method could not be found', 404, ifsetor($e));
		}

		/**
		 * This method will create a NotFound object, which is used for show a 404 error
		 * 
		 * @param array $args
		 * @return object
		 */
		public static function notFound(array $args=null)
		{
			$route = array_merge(array(
				'NotFound',
				'Index'
				), $args);

			return ControllerFactory::route($route);
		}

	}