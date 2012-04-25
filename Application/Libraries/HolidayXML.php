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
			if(($data) && (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200)){
				//lets get some memory back !
				curl_close($curl); 

				try{
					// throw error + clean NS
					$this->_xml = new SimpleXMLElement($data, LIBXML_NSCLEAN | LIBXML_ERR_ERROR);
					return;
				}catch(Exception $e){
					// XML is perhaps a bad format... either way we are in a bad place now
				}
			}	
			
			throw new Exception('XML failure', 500, ifsetor($e));			
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

		public function searchFeed($search, $by)
		{
			if($this->_xml instanceof SimpleXMLElement){
				switch ($by) {
					case 'title':
					default:
						$by = 'title';
						break;

					case 'description':
						$by = 'description';
						break;
				}

				// Remove anything that isnt alphanumeric for security and such
				$search = strtolower(preg_replace('/[^A-Z0-9]/i', null, $search));

				// Since we dont have xPATH 2.0, need to use the crappy translate method
				$items = $this->_xml->xpath('channel/item[contains(translate(' . $by . ', "ABCDEFGHJIKLMNOPQRSTUVWXYZ", "abcdefghjiklmnopqrstuvwxyz"), "' . $search . '")]');

				if(!empty($items)){
					$result = array();

					// Again convert to a stupid object
					foreach($items as $item){
						array_push($result, new Holiday(get_object_vars($item)));
					}

					return new ArrayIterator($result);	
				}
			}

			return null;			
		}

		public function getHolidayFromGuid($guid)
		{
			if($this->_xml instanceof SimpleXMLElement){
				$holiday = $this->_xml->xpath('channel/item[guid="' . $guid . '"]');

				if(!empty($holiday)){
					return new Holiday(array_shift($holiday));
				}
			}

			return null;
		}

		/**
		* This method grabs the XML then converts it into a Holiday Object, for safe use in our View... as a stupid object
		*/
		public function getHolidayObjects()
		{
			$items = (array)$this->getFeed();
			$result = array();

			foreach($items as $item){
				array_push($result, new Holiday(get_object_vars($item)));
			}

			return new ArrayIterator($result);			
		}

	}