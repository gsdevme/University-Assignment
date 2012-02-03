<?php

	class Home extends AbstractController
	{

		public function index()
		{						
			$this->view('home', array(
				'foobar' => 'Lemon',
				'x' => array('foo', 'moo')
			))->render();
		}

	}