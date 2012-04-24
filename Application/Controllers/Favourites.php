<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 23rd April 2012
	 *
	 * Favourites controller
	 */
	class Favourites extends AbstractController
	{

		public function __construct(Bootstrap $bootstrap, $controller, $method)
		{
			parent::__construct($bootstrap, $controller, $method);

			//protect favs from guests
			if(!$this->user){
				$this->redirect('auth/login/' . urlencode(base64_encode('In order to view favourites you must login')));				
			}
		}

		/**
		 * Index page
		 * 
		 * Pulls all the favourites from the database for any given user
		 */
		public function index($message=null)
		{				
			if($message !== null){
				$message = base64_decode(urldecode($message));
			}

			$this->title = 'Favourites - Second Rate Holidays';
			$this->description = 'Your favourite holidays';
			$this->keywords = 'home, second, rate, holidays, package, deals, flight, inclusive, world';

			return $this->view('holidays', array(
				'holidays' => Factory::model('Users')->getHolidays(),
				'message' => ifsetor($message),
			))->render();			
		}

		public function toggle($guid)
		{
			$guid = base64_decode(urldecode($guid));
			$holiday = Factory::library('HolidayXML')->getHolidayFromGuid($guid);

			if($holiday !== null){
				$result = Factory::model('Users')->toggleHoliday($holiday);
				
				if($result === 4){
					return $this->index(urlencode(base64_encode('That holiday has been added to your favourites')));
				}

				return $this->index(urlencode(base64_encode('The holiday has been removed from your favourites')));
			}

			return $this->index(urlencode(base64_encode('Failed to find that holiday to add to your favourites')));
		}

	}