<?php

	class NotFound extends Controller
	{

		public function index(Exception $exception=null)
		{
			$this->view('notfound', array('exception' => $exception)->render();
		}

	}