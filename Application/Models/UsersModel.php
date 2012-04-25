<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 23rd April 2012
	 *
	 * Users model, this will takl to the database and such to process user related things...
	 */	
	class UsersModel extends Model
	{
		const AUTHENTICATE_FIELD_ERROR = 1;
		const AUTHENTICATE_INVALID_EMAIL = 2;
		const AUTHENTICATE_FAILED = 3;

		const HOLIDAY_SAVED = 4;
		const HOLIDAY_REMOVED = 5;

		/**
		 * Authenticates the user against the MYSQL database
		 */
		public function authenticate()
		{
			if((isset($_POST['email'], $_POST['password'])) && (!empty($_POST['email'])) && (!empty($_POST['password']))){
				if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
					// Since theres no hashing going on with the example database its sad we dont need any sha512 or some salts :(
					$result = Factory::db()->query('SELECT email, name, password, admin, lastlogin FROM subscriber WHERE email=? AND password=? LIMIT 1', $_POST['email'], $_POST['password']);

					if($result !== null){
						$_SESSION['user'] = ( object )array_shift($result);

						$this->_registerSavedHolidaysChecksum();

						return ( bool )true;
					}

					return UsersModel::AUTHENTICATE_FAILED;
				}

				return UsersModel::AUTHENTICATE_INVALID_EMAIL;
			}

			return UsersModel::AUTHENTICATE_FIELD_ERROR;
		}

		/**
		 * Returns all saved holidays for any given user
		 */
		public function getHolidays()
		{
			$results = Factory::db()->query('SELECT holidayID, link, pubDate, title, description FROM saved_holidays WHERE subscriberID=? ORDER BY dateSaved', $_SESSION['user']->email);

			if($results !== null){
				$result = array();

				foreach($results as $item){
					array_push($result, new Holiday(get_object_vars($item)));
				}

				return new ArrayIterator($result);	
			}

			return null;
		}

		/**
		 * Toggles the saved holidays, either add/delete
		 */
		public function toggleHoliday(Holiday $holiday)
		{
			$check = Factory::db()->query('SELECT holidayID FROM saved_holidays WHERE link=? AND subscriberID=? LIMIT 1', $holiday->guid, $_SESSION['user']->email);

			// We dont have the holiday, lets save it
			if($check === null){
				Factory::db()->query('INSERT INTO saved_holidays (subscriberID, link, pubDate, title, description, dateSaved) VALUES (?,?,?,?,?,CURRENT_TIMESTAMP())', $_SESSION['user']->email, $holiday->guid, date('Y-m-d H:i:s', strtotime($holiday->pubDate)), $holiday->xmlTitle, $holiday->description);

				$this->_registerSavedHolidaysChecksum();

				return UsersModel::HOLIDAY_SAVED;
			}

			Factory::db()->query('DELETE FROM saved_holidays WHERE subscriberID=? AND link=? LIMIT 1', $_SESSION['user']->email, $holiday->guid);		
			
			$this->_registerSavedHolidaysChecksum();	

			return UsersModel::HOLIDAY_REMOVED;
		}

		private function _registerSavedHolidaysChecksum()
		{
			$_SESSION['holidays'] = array();
			$result = Factory::db()->query('SELECT link FROM saved_holidays WHERE subscriberID=?', $_SESSION['user']->email);
			
			if($result !== null){
				foreach($result as $holiday){
					$checksum = sprintf('%u', crc32($holiday->link));
					$_SESSION['holidays'][$checksum] = true;
				}	
			}
		}
	}