<?php

	class Home
	{
		public function __construct()
		{
			pre('hello');
		}

		public function index()
		{
			pre($this);
		}

	}