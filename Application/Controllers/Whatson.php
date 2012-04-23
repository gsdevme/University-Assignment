<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 23rd April 2012
	 *
	 * Just an example page really, not needed but really you need more then 1 page
	 */
	class Whatson extends AbstractController
	{

		/**
		 * Index page
		 */
		public function index()
		{					
			$this->title = 'Whats on - Second Rate Holidays';
			$this->description = 'All inclusive holidays from egypt to jamaica, we provide some of the greatest holidays the world has the offer.';
			$this->keywords = 'home, second, rate, holidays, package, deals, flight, inclusive, world';

			array_push($this->breadcrumb, array('whatson', 'What\'s On'));

			$this->view('whatson')->render();
		}

	}