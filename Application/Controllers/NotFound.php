<?php

	class NotFound extends AbstractController
	{

		public function index(Exception $exception=null)
		{
			$this->title = '404 Not Found - Second Rate Holidays';

			$this->view('notfound', array('exception' => $exception))->render(array(
				'HTTP/1.1 404 Not Found'
			));
		}

	}