<?php

	class Factory
	{

		/**
		* Loads a model
		*
		* Since we dont have namespaces we are going to run into the problem with a User Model & User Controller,
		* therefore Models are appended with "Model", so Class UserModel{}
		*
		* @param string $name this is the name of the model
		* @param array $args this is any arguments you wish to send 
		* @return object the model object
		*/
		public static function model($name, array $args=null)
		{
			$name = ucfirst($name) . 'Model';
				
			try{
				$class = new ReflectionClass($name);

				// Does it have a Public constructor.
				if($class->isInstantiable()){
					return ($args === null) ? $class->newInstance() : $class->newInstanceArgs((array)$args);
				}

				// Hmm not public constructor, perhaps has a singleton style setup...
				if($class->hasMethod('getInstance')){
					return call_user_func_array(array($name, 'getInstance'), $args);
				}				

				throw new FactoryException('The model ' . $name . ' was found but we couldn\'t create an instance nor did we find a method getInstance() for singleton.', 500);				
			}catch(ClassNotFoundException $e){
				
			}

			throw new FactoryException('The Factory could not find the Model named ' . $name, 500, ifsetor($e));
		}

		public static function library($name, array $args=null)
		{
			
		}

	}