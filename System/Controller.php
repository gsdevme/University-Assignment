<?php

	abstract class Controller
	{
		protected $bootstrap;
		
		public function __construct(Bootstrap $bootstrap)
		{
			$this->$bootstrap = $bootstrap;
		}
		
		protected function view($view)
		{

		}
		
		
	}