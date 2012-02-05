<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 4th February 2012
	 *
	 * Since we dont want to repeatly call the XML from another web server, this class is yet another singleton
	 */	
	class HolidayXML
	{
		private static $_instance;
		private $_xml;

		private function __construct()
		{
			$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => 'http://www.numyspace.co.uk/~cgel1/holidays/holidays.xml',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER => false,
			));

			$data = curl_exec($curl);

			// Lets check we got the XML, and HTTP CODE 200
			if((!empty($data)) && (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200)){
				try{
					// throw error + clean NS
					$this->_xml = new SimpleXMLElement($data, LIBXML_NSCLEAN | LIBXML_ERR_ERROR);
					return;
				}catch(Exception $e){
					// XML is perhaps a bad format... either way we are in a bad place now
				}
			}	
			
			throw new Exception('FF', 500, ifsetor($e));			
		}

		public static function getInstance()
		{
			if(!self::$_instance instanceof self){
				self::$_instance = new self;
			}

			return self::$_instance;
		}
		
		public function getFeed()
		{
			if($this->_xml instanceof SimpleXMLElement){
				$items = $this->_xml->xpath('channel/item');

				if(!empty($items)){
					return (array)$items;
				}
			}

			return null;
		}

		/**
		* This method grabs the XML then converts it into a Holiday Object, for safe use in our View... as a stupid object
		*/
		public function getHolidayObjects()
		{
			if($this->_xml instanceof SimpleXMLElement){
				$items = $this->_xml->xpath('channel/item');

				if(!empty($items)){
					$result = array();

					foreach($items as $item){
						array_push($result, new Holiday(get_object_vars($item)));
					}

					return new ArrayIterator($result);
				}
			}

			return null;			
		}

	}