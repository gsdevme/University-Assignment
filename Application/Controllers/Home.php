<?php

	class Home extends AbstractController
	{

		public function index()
		{						
			$this->view('home', array(
				'holidays' => Factory::library('HolidayXML')->getHolidayObjects(),
			))->render();
		}

	}