<?php

	class ViewFactory
	{

		private static $_instance;
		protected $views;

		private function __construct()
		{
			$this->views = array();
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
		 * @param string $name
		 * @param array $data
		 * @param bool $shared 
		 */
		public function addView($name, array $args=null)
		{
			$file = Bootstrap::getInstance()->getRoot() . 'Application/Views/' . $name . '.php';
			$view = sprintf('%u', crc32($file));

			if (!isset($this->views[$view])) {
				if (is_readable($file)) {
					$this->views[$view] = ( object ) array('file' => $file, 'args' => $args, 'name' => $name);
					return self::$_instance;
				}

				throw new ViewException('Failed to load view, could not find ' . $name, 404, null);
			}

			return self::$_instance;
		}

		public function render()
		{
			if (!empty($this->views)) {
				ob_start();
				
				foreach ($this->views as $view) {
					new View($view->file, $view->args);
				}

				return true;
			}

			throw new ViewException('No views where found, make sure you use $this->view() before $this->render()', 404);
		}

	}