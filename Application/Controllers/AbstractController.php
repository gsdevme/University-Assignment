<?php

	/**
	 * @author Gavin Staniforth <Email:gsdev@me.com> <Arpanet:http://gsdev.me> @gsphpdev
	 * @version 1.0, 23rd April 2012
	 *
	 * Abstract controller for the application
	 */
	abstract class AbstractController extends Controller
	{
		// Protected properties across the contollers, used within the View overload
		protected $title, $description, $keywords, $breadcrumb, $url, $css, $img, $js, $user;
		
		/**
		 * Get some properties set
		 * 
		 * @param Bootstrap $bootstrap
		 * @param string $controller
		 * @param string $method 
		 */		
		public function __construct(Bootstrap $bootstrap, $controller, $method)
		{
			$this->url = $bootstrap->getUrl();
			$this->css = $this->url . 'Public/css/';
			$this->img = $this->url . 'Public/img/';
			$this->js = $this->url . 'Public/js/';
			
			$this->breadcrumb = array(
				array('home', 'Home'),
			);

			// lets start a session, but just make sure we aint starting one which is already made
			if(!isset($_SESSION)){
				session_start();
			}

			// Is there any users logged in?
			if(isset($_SESSION['user'], $_SESSION['holidays'], $_SESSION['__ip_checksum'])){
				// Lock sessions to IPs
				if($_SESSION['__ip_checksum'] == sprintf('%u', crc32($bootstrap->getServerParam('remote_addr')))){

					$this->user = ( object )$_SESSION['user'];

					/**
					 * We only really need to regenerate the session ID if there is a user,
					 * there is no security advant to creating loads of sessions where they are empty, 
					 * your just wasting 4k on your harddrive aswell as wasting headers in the HTTP request
					 */
					session_regenerate_id();
				}else{
					// Reset the session to be a blank array :) as the IP has change... perhaps stolen!!
					$_SESSION = array();
				}
			}

			// Register IP
			$_SESSION['__ip_checksum'] = sprintf('%u', crc32($bootstrap->getServerParam('remote_addr')));		
			
			parent::__construct($bootstrap, $controller, $method);
		}

		/**
		 * Simple method to just prepend the value & redirect while also killing the script
		 * 
		 * @param  string $url
		 */
		protected function redirect($url)
		{
			header('location: ' . $this->url . $url);
			exit(0);
		}
		
		/**
		 * View overload to pass some key information
		 * 
		 * @param  string $view 
		 * @param  array $args=null
		 */
		protected function view($view, array $args=null)
		{
			return parent::view($view, array_merge((array)$args, array(
				'title' => $this->title,
				'description' => $this->description,
				'keywords' => $this->keywords,
				'breadcrumb' => $this->breadcrumb,
				'css' => $this->css,
				'img' => $this->img,
				'url' => $this->url,
				'js' => $this->js,
				'controller' => $this->controller,
				'user' => $this->user
			)));
		}
	}