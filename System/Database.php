<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 4th February 2012
	 *
	 * This class is used as a database abstract layer between any Models and PDO, also ensures 
	 * only 1 connection to the database is made at anyone time
	 */	
	class Database
	{

		private static $_instance;
		private $_pdo;

		/**
		 * Private construtor to inforce singleton
		 * 
		 * @param Bootstrap $bootstrap
		 */
		private function __construct(Bootstrap $bootstrap)
		{
			$connection = $bootstrap->getPDOConnectionDetails();

			try{
				// Connect & set the database up for friendly UTF-8
				$this->_pdo = new PDO($connection->dns, $connection->user, $connection->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

				// We want real programming errors so get PDO to throw
				$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return;
			}catch(PDOException $e){

			}

			throw new DatabaseException('Failed to connect to the database', null, ifsetor($e));			
		}

		/**
		 * Singleton ftw
		 *
		 * @static
		 * @param ViewFactory
		 */
		public static function getInstance(Bootstrap $bootstrap=null)
		{
			if (!self::$_instance instanceof self) {
				self::$_instance = new self($bootstrap);
			}

			return self::$_instance;
		}

		/**
		 * This method will do alot of the processing and allow for a single method for almost any query
		 * 
		 * @example query('select * from bob where id=?', $id);
		 * @return mixed
		 */
		public function query()
		{
			$arguments = func_get_args();

			if(!empty($arguments)){
				$query = array_shift($arguments);

				// Detect what query we are doing
				$return = ( bool ) !preg_match('/(^INSERT|^DELETE|^UPDATE)/i', $query);

				try{
					// Prepared statement, security FTW
					$stmt = $this->_pdo->prepare($query);

					// Does the query have any arguments to bind to it?
					$length = count($arguments);

					if($length > 0){
						for($i=0;$i<$length;++$i){
							// Lets get the Datatype of the Value, and also cast it
							$data = $this->_dataType($arguments[$i]);

							// Bind the values to the query
							$stmt->bindValue($i+1, $data->value, $data->type);
						}
					}

					// Thunderbirds we are go!, execute
					if ($stmt->execute()) {
						// Does the query want some kind of return?, like a select etc
						if ($return === true) {
							// Fetech the results into a lovely stdClass
							$data = $stmt->fetchAll(PDO::FETCH_CLASS);

							if (!empty($data)) {
								return ( array ) $data;
							}

							// The query returned nothing? well lets null
							return null;
						}

						// Is it an update or insert?
						if (preg_match('/^INSERT/i', $query)) {
							// for an insert lets get the ID!
							return ( int ) $this->lastInsertId();
						}

						// For update lets check the row count
						return ( int ) $stmt->rowCount();
					}

					throw new DatabaseException('Query failed, Query: ' . $stmt->queryString, null);					
				}catch(PDOException $e){

				}
			}

			throw new DatabaseException('Query method wasnt passed any parameters', null, ifsetor($e));
		}

		/**
		 * Allow access to the standard PDO methods, via a proxy
		 *
		 * @param type $method
		 * @param type $args
		 * @return type 
		 */
		public function __call($method, $args)
		{
			return call_user_func_array(array($this->_pdo, $method), $args);
		}

		/**
		 * Returns the data type
		 * @param type $value
		 * @return type 
		 */
		private function _dataType(&$value)
		{
			switch (true) {
				case is_null($value):
					return ( object ) array('value' => null, 'type' => PDO::PARAM_NULL);
				case is_int($value):
					return ( object ) array('value' => ( int ) $value, 'type' => PDO::PARAM_INT);
				case is_bool($value):
					return ( object ) array('value' => ( bool ) $value, 'type' => PDO::PARAM_BOOL);
				default:
					return ( object ) array('value' => ( string ) $value, 'type' => PDO::PARAM_STR);
			}
		}		
	}