<?php

namespace Toeswade\Navigation; 
	
class CNavigation 
{

		private $main; // Main navigation array
		private $sub; // Sub navigation array
		private $view; 

		public function __construct( array $config ) 
		{
			if(isset($config['main'])) {
				$this->main = $config['main'];
			}

			if(isset($config['sub'])) {
				$this->sub = $config['sub'];
			}

			$this->view = new VNavigation();
			
		}

		/*
		 * @return string
		 */
		public function getMainNavigation() 
		{
			$mainNav = $this->view->renderNavigation($this->main);
			return $mainNav;
		}

}