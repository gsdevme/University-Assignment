<?php

	/**
	 * @author Gavin Staniforth
	 * @version 1.0, 29th January 2012
	 *
	 * This class is used to store the View data and then allow the method render() to instantiate them
	 */		
	class ViewFactory
	{

		private static $_instance;
		private $_views;

		/**
		 * Assigns an array to the view property
		 */
		private function __construct()
		{
			$this->_views = array();
		}

		public static function getInstance()
		{
			if (!self::$_instance instanceof self) {
				self::$_instance = new self;
			}

			return self::$_instance;
		}

		/**
		 * Add a view to the ADT Queue
		 * 
		 * @param string $name
		 * @param array $data
		 */
		public function addView($name, array $args=null)
		{
			$file = Bootstrap::getInstance()->getRoot() . 'Application/Views/' . $name . '.php';
			$view = sprintf('%u', crc32($file));

			if (!isset($this->_views[$view])) {
				if (is_readable($file)) {
					$this->_views[$view] = ( object ) array('file' => $file, 'args' => $args, 'name' => $name);
					return self::$_instance;
				}

				throw new ViewException('Failed to load view, could not find ' . $name, 404, null);
			}

			return self::$_instance;
		}

		/**
		 * Renders all views onto the page
		 * 
		 * @param bool 
		 */
		public function render()
		{
			if (!empty($this->_views)) {
				ob_start();
				
				foreach ($this->_views as $view) {
					new View($view->file, $view->args);
				}

				return true;
			}

			throw new ViewException('No views where found, make sure you use $this->view() before $this->render()', 404);
		}

	}