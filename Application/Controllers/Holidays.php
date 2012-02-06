<?php

	class Holidays extends AbstractController
	{

		public function index()
		{					
			$this->title = 'Holidays - Second Rate Holidays';
			$this->description = 'All inclusive holidays from egypt to jamaica, we provide some of the greatest holidays the world has the offer.';
			$this->keywords = 'home, second, rate, holidays, package, deals, flight, inclusive, world';

			array_push($this->breadcrumb, array('holidays', 'Holidays'));

			$this->view('holidays', array(
				'holidays' => Factory::library('HolidayXML')->getHolidayObjects(),
			))->render();
		}

	}