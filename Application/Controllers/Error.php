<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 23rd April 2012
	 *
	 * Error controller, will printout any errors in a nice format
	 */
	class Error extends AbstractController
	{

		public function index(Exception $exception=null)
		{			
			$this->view('error', array('exception' => $exception))->render();
		}

	}