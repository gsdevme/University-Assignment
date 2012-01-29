<?php

	abstract class AbstractController extends Controller
	{
		protected $title, $description, $keywords, $breadcrumb, $url, $css, $img;
		
		public function __construct(Bootstrap $bootstrap, $controller, $method)
		{
			$this->css = $bootstrap->getUrl() . 'Public/css/';
			$this->img = $bootstrap->getUrl() . 'Public/img/';
			$this->url = $bootstrap->getUrl();
			
			$breadcrumb = array(
				$controller,
			);
			
			parent::__construct($bootstrap, $controller, $method);
		}
		
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
			)));
		}
	}