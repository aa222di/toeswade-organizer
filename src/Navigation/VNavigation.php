<?php

namespace Toeswade\Navigation; 
	
class VNavigation 
{

		private $main; // Main navigation array
		private $sub; // Sub navigation array
		private $view; 

		public function __construct(  ) 
		{
			
		}

		/*
		 * @param associative array defined in config.php
		 * @return string
		 */
		public function renderNavigation( array $nav ) 
		{
			$html = '';
			foreach ($nav as $menuItem => $values) {
				extract($values);
				$url = $this->createUrl($url);
				$html .= "<li><a href='" . $url . "' title='" . $text . "'>" . $text . "</a></li>";
			}
			return $html;
		}

		/*
		 * @param $url string
		 * @return string
		 */
		private function createUrl( $url ) 
		{
			$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" . $url;
			$s = parse_url($url);
			var_dump($s);
			return $url;
		}

}