<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 29th January 2012
	 *
	 * This class is used like an factory pattern class and creates objects, 
	 * it uses reflection to 'make it so' (ha clever comment joke...)
	 */
	class ControllerFactory
	{

		/**
		 * Routes the array to the Controller/Action/Args using Reflection
		 * 
		 * @static
		 * @param array $route 
		 * @return object
		 */
		public static function route(array $route)
		{
			// Store actual Route, within the REQUEST_URI server
			Bootstrap::getInstance()->setServerUri(implode('/', $route));

			$controller = ucfirst(urldecode(array_shift($route)));

			try {
				$class = new ReflectionClass($controller);
				$method = new ReflectionMethod($controller, urldecode(array_shift($route)));

				if (($method->isPublic()) && ($class->isInstantiable())) {
					// is there any arguments ?					
					if ((count($route) == 0) && ($method->getNumberOfRequiredParameters() == 0)) {
						return $method->invoke($class->newInstance(Bootstrap::getInstance(), $class->name, $method->name), null);
					}

					// are we sending the correct amount of parameters ?
					if (count($route) >= $method->getNumberOfRequiredParameters()) {
						return $method->invokeArgs($class->newInstance(Bootstrap::getInstance(), $class->name, $method->name), $route);
					}

					throw new RouterException('The controller method was not sent the correct amount of parameters', 404);
				}

				throw new RouterException('The method is either not public or the class is not isInstantiable', 404);
			} catch (ClassNotFoundException $e) {
				// catch it for Line 51
			}

			$route = func_get_args();

			throw new RouterException('The controller/method could not be found | ' . implode('::', array_slice($route[0], 0, 2)) . '()', 404, ifsetor($e));
		}

		/**
		 * This method will create a NotFound object, which is used for show a 404 error
		 * 
		 * @static
		 * @param array $args
		 * @return object
		 */
		public static function notFound(array $args=null)
		{
			$route = array_merge(array(
				'NotFound',
				'index'
				), $args);

			return ControllerFactory::route($route);
		}

	}