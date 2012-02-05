<?php

	class Home extends AbstractController
	{

		public function index()
		{					
			$this->title = 'Home - Second Rate Holidays';
			$this->description = 'All inclusive holidays from egypt to jamaica, we provide some of the greatest holidays the world has the offer.';
			$this->keywords = 'home, second, rate, holidays, package, deals, flight, inclusive, world';

			$this->view('home', array(
				'holidays' => Factory::library('HolidayXML')->getHolidayObjects(),
			))->render();
		}

	}