<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 23rd April 2012
	 *
	 * This is used as a Struct might be used within C++, it offers a structure while also doing 
	 * abit of parsing on the title to clean it up
	 */	
	class Holiday
	{

		private $_id, $_title, $_offer, $_link, $_description, $_pubDate, $_guid;

		public function __construct($item)
		{
			foreach($item as $property => $value){
				$name = '_' . $property;

				if(property_exists($this, $name)){
					$this->$name = $value;
				}			
			}

			/*
			* Lets try and parse out the offer from the title... (could explode it but wont be as fast)
			* 
			* Since some of the XML titles have | and some have - we need to figure it out... "sigh :(".. 
			* i would think Regex is too much overhead though
			*/
			$this->_offer = trim(substr(strrchr($this->_title, '|'), 2));

			if(empty($this->_offer)){
				$this->_offer = trim(substr(strrchr($this->_title, '-'), 2));
			}

			// Now lets remove the offer sttring from the title
			$this->_title = trim(substr(str_replace($this->_offer, null, $this->_title), 0, -3));

			// Lets create an integer ID based upon the GUID.... (which it if its a real one shouldn't change)
			if(!isset($this->_id)){
				$this->_id = sprintf('%u', crc32($this->_guid));
			}
		}

		public function __get($name)
		{
			$name = '_' . $name;
			return ((isset($this->$name)) && (!empty($this->$name))) ? $this->$name : null;
		}
	}