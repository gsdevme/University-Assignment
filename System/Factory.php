<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 4th February 2012
	 *
	 * This class is used like an factory pattern class and creates objects, 
	 * Loads Models & Libraries
	 */	
	class Factory
	{

		/**
		* Loads a model
		*
		* Since we dont have namespaces we are going to run into the problem with a User Model & User Controller,
		* therefore Models are appended with "Model", so Class UserModel{}
		*
		* @static
		* @param string $name this is the name of the model
		* @param array $args this is any arguments you wish to send 
		* @return object the model object
		*/
		public static function model($name, array $args=null)
		{
			return self::_loader(ucfirst($name) . 'Model', $args, 'model');	
		}

		/**
		 * Loads a model
		 * 
		 * @static		 
		 * @param string $name
		 * @param array $args
		 * @return object 
		 */
		public static function library($name, array $args=null)
		{
			return self::_loader(ucfirst($name), $args, 'library');	
		}

		/**
		 * Loads the database abstration 
		 * @return Database
		 */
		public static function db()
		{
			return self::_loader('Database', array(Bootstrap::getInstance()));	
		}

		/**
		 * Loads classes via the constructor or through getInstance singleton method
		 * 
		 * @static
		 * @param string $name
		 * @param array $args
		 * @param string $type
		 * @return object 
		 */
		private static function _loader($name, array $args=null, $type=null)
		{
			try{
				$class = new ReflectionClass($name);

				// Does it have a Public constructor.
				if($class->isInstantiable()){
					return ($args === null) ? $class->newInstance() : $class->newInstanceArgs((array)$args);
				}

				// Hmm not public constructor, perhaps has a singleton style setup...
				if($class->hasMethod('getInstance')){
					return call_user_func_array(array($name, 'getInstance'), (array)$args);
				}				

				throw new FactoryException('The ' . $type . ' ' . $name . ' was found but we couldn\'t create an instance nor did we find a method getInstance() for singleton.', 500);				
			}catch(ClassNotFoundException $e){
				
			}

			throw new FactoryException('The Factory could not find the ' . $type . ' named ' . $name, 500, ifsetor($e));			
		}

	}