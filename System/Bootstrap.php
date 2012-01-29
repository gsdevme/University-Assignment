<?php

	class Bootstrap
	{

		private static $_instance;
		private $_config, $_fileLocations;

		private function __construct()
		{
			$this->_config = new stdClass;
			$this->_fileLocations = array();
		}

		public static function getInstance()
		{
			if (!self::$_instance instanceof self) {
				self::$_instance = new self;
			}

			return self::$_instance;
		}

		public static function autoLoader($class)
		{
			foreach (self::$_instance->_fileLocations as $file) {
				$file = $file . str_replace('_', '/', $class) . '.php';

				if (is_readable($file)) {
					return require_once $file;
				}
			}

			throw new ClassNotFoundException('Class ' . $class . ' not found');
		}

		/**
		 *
		 * @return type 
		 */
		public function setupEnvironment()
		{
			error_reporting(-1);
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);

			ini_set('date.timezone', 'Europe/London');
			ini_set('default_charset', 'UTF-8');

			ini_set('short_open_tag', 0);

			ini_set('magic_quotes_gpc', 0);

			return self::$_instance;
		}

		/**
		 *
		 * @return type 
		 */
		public function setupAutoLoader()
		{
			spl_autoload_register('Bootstrap::autoLoader');

			return self::$_instance;
		}

		/**
		 *
		 * @param type $user
		 * @return type 
		 */
		public function configurePaths($user=null)
		{
			$this->_config->root = realpath(dirname(__FILE__)) . '/../';
			$this->addFileLocation(null);

			$this->_config->url = (((isset($_SERVER['HTTPS'])) && (!empty($_SERVER['HTTPS']))) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . '/';

			if ($_SERVER['HTTP_HOST'] == 'www.numyspace.co.uk') {
				$this->_config->numyspaceId = $user;
				$this->_config->url .= $user . '/';
			}

			return self::$_instance;
		}

		/**
		 *
		 * @param type $location
		 * @return type 
		 */
		public function addFileLocation($location)
		{
			return array_push($this->_fileLocations, self::$_instance->_config->root . $location);
		}

		/**
		 *
		 * @return type 
		 */
		public function getUrl()
		{
			return ( string ) $this->_config->url;
		}

		/**
		 *
		 * @return type 
		 */
		public function getRoot()
		{
			return ( string ) $this->_config->root;
		}

		/**
		 *
		 * @return type 
		 */
		public function isNumyspace()
		{
			return ( bool ) isset($this->_config->numyspaceId);
		}

		/**
		 *
		 * @return type 
		 */
		public function getNumyspaceId()
		{
			return ( string ) $this->_config->numyspaceId;
		}

	}