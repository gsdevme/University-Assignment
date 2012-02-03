<?php

	class NotFound extends AbstractController
	{

		public function index(Exception $exception=null)
		{
			$this->view('notfound', array('exception' => $exception))->render();
		}

	}