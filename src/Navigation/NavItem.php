<?php

namespace Toeswade\Navigation; 
	
class NavItem
{

		private $text; 
		private $url; 
		private $controller; 
		private $action; 

		/* Create menu item with text and url, and (optional) controller (obj) and action (string to method on object)
		 *
		 *
		 */
		public function __construct( $text, $url, $controller=null, $action=null ) 
		{
			if(is_string($text)) {
				$this->text = $text;
			}
			else {
				throw new \Exception('text for navigation item must be a string');
			}
			if(is_string($url)) {
				$this->url = $url;
			}
			else {
				throw new \Exception('url for navigation item must be a string');
			}

			if(isset($controller)) {
				if(is_object($controller)) {
					$this->controller = $controller;
				}
				else {
					throw new \Exception('Controller must be an object');
				}
			}

			if(isset($action)) {
				if(is_string($action)) {
					$this->action = $action;
				}
				else {
					throw new \Exception('Action must be a string');
				}
			}
		}

		// GETTERS

		public function getController() 
		{
			return $this->controller;
		}


		public function getUrl() 
		{
			return $this->url;
		}

		
		public function getText() 
		{
			return $this->text;
		}

		public function getAction() 
		{
			return $this->action;
		}




}