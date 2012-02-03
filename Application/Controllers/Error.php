<?php

	class Error extends AbstractController
	{

		public function index(Exception $exception=null)
		{			
			$this->view('notfound', array('exception' => $exception))->render();
		}

	}