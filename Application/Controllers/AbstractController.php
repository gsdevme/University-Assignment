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
		protected $title, $description, $keywords, $breadcrumb, $url, $css, $img, $js;
		
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
			
			parent::__construct($bootstrap, $controller, $method);
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
				'controller' => $this->controller
			)));
		}
	}