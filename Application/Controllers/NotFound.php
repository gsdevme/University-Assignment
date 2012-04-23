<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 23rd April 2012
	 *
	 * the 404 not found page :)
	 */
	class NotFound extends AbstractController
	{

		/**
		 * Simple index method, also takes an exception as a parameter for future debugging
		 */
		public function index(Exception $exception=null)
		{
			$this->title = '404 Not Found - Second Rate Holidays';

			$this->view('notfound', array('exception' => $exception))->render(array(
				'HTTP/1.1 404 Not Found'
			));
		}

	}