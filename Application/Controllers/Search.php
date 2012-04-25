<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 23rd April 2012
	 *
	 * Search controller, searches the XML
	 */
	class Search extends AbstractController
	{

		public function index()
		{			
			array_push($this->breadcrumb, array('search', 'Search'));

			if((isset($_POST, $_POST['search'], $_POST['searchby'])) && (!empty($_POST['search'])) && (!empty($_POST['searchby']))){
				$results = Factory::library('HolidayXML')->searchFeed($_POST['search'], $_POST['searchby']);
			}

			$this->title = 'Search Results - Second Rate Holidays';

			$this->view('holidays', array(
				'holidays' => ifsetor($results),
			))->render();			
		}

	}