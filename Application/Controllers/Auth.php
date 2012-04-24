<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 23rd April 2012
	 *
	 * Authenication controller
	 */
	class Auth extends AbstractController
	{

		/**
		 * Setup the breadcrumb for easy navigation
		 * 
		 * @param Bootstrap $bootstrap
		 * @param string $controller
		 * @param string $method 
		 */
		public function __construct(Bootstrap $bootstrap, $controller, $method)
		{
			parent::__construct($bootstrap, $controller, $method);

			array_push($this->breadcrumb, array('auth', 'Auth'));
	
			$this->description = 'All inclusive holidays from egypt to jamaica, we provide some of the greatest holidays the world has the offer.';
			$this->keywords = 'login, sighome, second, rate, holidays, package, deals, flight, inclusive, world';			
		}		

		/**
		 * Simple alias method
		 */
		public function index()
		{
			return $this->login();
		}

		public function login($alert=null)
		{
			$message = ($alert !== null) ? base64_decode(urldecode($alert)) : null;

			// if already logged in, lets log them out
			if($this->user){
				return $this->logout();
			}

			$this->title = 'Login - Second Rate Holidays';

			array_push($this->breadcrumb, array('auth/login', 'Login'));

			// Do we have some POST data?
			if((isset($_POST)) && (!empty($_POST))){
				if(($rs = Factory::model('Users')->authenticate()) === true){
					$this->redirect('home');
				}

				switch($rs){
					case 1: 
						$message = 'You must complete all the fields.';
						break;
					case 2: 
						$message = 'Email address is invaild, please check.';
						break;
					case 3: 
						$message = 'Email & Password do not match';
						break;
					default:
						break;

				}
			}

			$this->view('auth', array(
				'form' => 'login',
				'message' => ifsetor($message),
			))->render();
		}

		public function signup()
		{
			$this->title = 'Register - Second Rate Holidays';

			array_push($this->breadcrumb, array('auth/signup', 'Signup'));

			$this->view('auth', array(
				
			))->render();			
		}

		public function logout()
		{
			$_SESSION = array();
			$this->redirect('home');
		}

	}