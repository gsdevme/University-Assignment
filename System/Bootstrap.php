<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 4th February 2012
	 *
	 * This class is used to bootstrap the server into a workable state, it also provides 
	 * the autoloading and acts as registry for the application
	 */	
	class Bootstrap
	{

		private static $_instance;
		private $_config, $_fileLocations;

		/**
		 * Sets up some properties, and assigns the $_SERVER within the bootstrap.
		 * 
		 * @param array $server 
		 */
		private function __construct(array $server)
		{
			$this->_config = new stdClass;
			$this->_fileLocations = array();

			$this->_config->server = ( object ) $server;
		}

		/**
		 * for the Singleton class, so we can get the $_instance
		 * 
		 * @static
		 * @param array $server
		 * @return Bootstrap
		 */
		public static function getInstance(array $server=null)
		{
			if (!self::$_instance instanceof self) {
				self::$_instance = new self($server);
			}

			return self::$_instance;
		}

		/**
		 * Autoloader method will auto include the file we need for our class
		 * 
		 * @static
		 * @param string $class
		 * @return mixed 
		 */
		public static function autoLoader($class)
		{
			// Could of used set_include_path but its likely to be slower, also due to shared server environment it might be blocked
			foreach (self::$_instance->_fileLocations as $file) {
				$file = $file . str_replace('_', '/', $class) . '.php';

				if (is_readable($file)) {
					return require_once $file;
				}
			}

			return (bool)false;
		}

		/**
		 * This is some ugly code, but since the server env and dev are so different 
		 * its a must, also its not possible to change the server ones
		 * 
		 * @return Bootstrap
		 */
		public function setupEnvironment()
		{
			// Setup Server for Error Reporting
			error_reporting(-1);
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);

			// Enable gzip compression
			ini_set('zlib.output_compression', 1);
			ini_set('zlib.output_compression_level', '9');

			// Increase file cache 
			ini_set('realpath_cache_size', '1024K');
			ini_set('realpath_cache_ttl', '3600');

			// Set Timezone, and Charset of UTF-8
			ini_set('date.timezone', 'Europe/London');
			ini_set('default_charset', 'UTF-8');

			// Disable shorttag
			ini_set('short_open_tag', 0);

			// Disable magic quotes (Lovely magic quotes enabled on the server.... a developers worst nightmare)
			ini_set('magic_quotes_gpc', 0);

			// Since its likely everyone at Uni will use the default might be best to do this
			ini_set('session.name', 'w11025228');

			return self::$_instance;
		}

		/**
		 * Lets configure our errors to throw rather then to just add to the buffer
		 * 
		 * I will never understand why this isn't the default in PHP...
		 * 
		 * @return Bootstrap
		 */
		public function setErrorException()
		{
			set_error_handler(create_function('$errno, $errstr, $errfile, $errline', 'throw new ErrorException($errstr, 0, $errno, $errfile, $errline);'));

			return self::$_instance;
		}

		/**
		 * Register our autoload method using the spl_autoload ..
		 * 
		 * @return Bootstrap 
		 */
		public function setupAutoLoader()
		{
			spl_autoload_register('Bootstrap::autoLoader');

			return self::$_instance;
		}

		/**
		 * This is setup our paths, also fixing if its on numyspace
		 * 
		 * @param string $user
		 * @return Bootstrap
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
		 * Sets the PDO Connection settings
		 * 
		 * @param stdClass $connectionDetails
		 * @return Bootstra[ 
		 */
		public function setPDOConnectionDetails(stdClass $connectionDetails)
		{
			$this->_config->connectionDetails = $connectionDetails;

			return self::$_instance;
		}

		/**
		 * Adds another folder location to search for within our autoloader
		 * 
		 * @param string $location
		 * @return Bootstrap
		 */
		public function addFileLocation($location)
		{
			array_push($this->_fileLocations, self::$_instance->_config->root . $location);

			return self::$_instance;
		}

		/**
		 * Gets the server URL
		 * 
		 * @return string
		 */
		public function getUrl()
		{
			return ( string ) $this->_config->url;
		}

		/**
		 * Gets the server Root (or if your a windows fanboy that would be PATH)
		 * 
		 * @return string 
		 */
		public function getRoot()
		{
			return ( string ) $this->_config->root;
		}

		/**
		 * Boolean based on if we are running on numyspace or not
		 * 
		 * @return boolean 
		 */
		public function isNumyspace()
		{
			return ( bool ) isset($this->_config->numyspaceId);
		}

		/**
		 * The numyspace ID
		 * 
		 * @return string 
		 */
		public function getNumyspaceId()
		{
			return ( string ) $this->_config->numyspaceId;
		}

		/**
		 * Gets one of the $_SERVER values from our $_config->server
		 * 
		 * @param string $param
		 * @return mixed 
		 */
		public function getServerParam($param)
		{
			$param = (strtoupper($param));
			return $this->_config->server->$param;
		}

		/**
		 * Sets the REQUEST_URI param within the object 
		 * 
		 * @param string $value
		 * @return boolean
		 */
		public function setServerUri($value)
		{
			return $this->_config->server->REQUEST_URI = $value;
		}

		/**
		 * Returns the PDO Connection details
		 * 
		 * @return stdClass 
		 */
		public function getPDOConnectionDetails()
		{
			return ( object ) $this->_config->connectionDetails;
		}

	}