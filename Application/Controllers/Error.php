<?php

	class Error extends AbstractController
	{

		public function index(Exception $exception=null)
		{			
			$this->view('error', array('exception' => $exception))->render();
		}

	}