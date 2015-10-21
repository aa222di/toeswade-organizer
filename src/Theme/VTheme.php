<?php

namespace Toeswade\Theme; 
	
class VTheme 
{

		private $theme; // Array that hold path to theme templates
		/*
		 *
		 */
		public function __construct( $theme ) 
		{
			$this->theme = $theme;
		}

		/*
		 * Final method call in project. Renders full html page
		 * @param associative array with content to be injected in page.tpl.php
		 * @return HTML page
		 */
		public function render( array $content ) {
			extract($content);
			include($this->theme['path'] . '/templates/page.tpl.php');
			//die;
		}

}