<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 23rd April 2012
	 *
	 * Home page controller
	 */
	class Home extends AbstractController
	{

		/**
		 * Index page
		 * 
		 * Pulls the XML feed down then displays it.. nothing much more
		 */
		public function index()
		{					
			$this->title = 'Home - Second Rate Holidays';
			$this->description = 'All inclusive holidays from egypt to jamaica, we provide some of the greatest holidays the world has the offer.';
			$this->keywords = 'home, second, rate, holidays, package, deals, flight, inclusive, world';

			$this->view('holidays', array(
				'holidays' => Factory::library('HolidayXML')->getHolidayObjects(),
			))->render();
		}

	}