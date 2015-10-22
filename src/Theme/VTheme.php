<?php

namespace Toeswade\Theme; 
	
class VTheme 
{

		private $path; // Array that hold path to theme templates
		private $nav;
		private $main;
		private $title;

		private static $pathToPageTemplate = '/templates/page.tpl.php';

		/*
		 *
		 */
		public function __construct( $pathToTheme ) 
		{
			$this->path = $pathToTheme;
		}

		/*
		 * Final method call in project. Renders full html page
		 * @param associative array with content to be injected in page.tpl.php
		 * @return HTML page
		 */
		public function render() 
		{

			include($this->path . self::$pathToPageTemplate);
			//die;
		}

		public function setNav( $nav ) 
		{
			$this->nav = $nav;
		}

		public function setMain( $main ) 
		{
			$this->main = $main;
		}

		public function setTitle( $title ) 
		{
			$this->title = $title;
		}

}