<?php

	class Error extends Controller
	{

		public function index(Exception $exception=null)
		{			
			$this->view('notfound', array('exception' => $exception)->render();
		}

	}