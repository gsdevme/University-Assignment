<?php

	class Home extends Controller
	{
		public function __construct($bootstrap)
		{
			parent::__construct($bootstrap);
			
			pre('hello');
		}

		public function index($foo, $a=null)
		{
			echo '<pre>' . print_r(func_get_args(), 1) . '</pre>';
		}

	}