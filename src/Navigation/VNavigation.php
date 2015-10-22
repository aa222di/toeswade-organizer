<?php

namespace Toeswade\Navigation; 
	
class VNavigation 
{

		private $main; // Main navigation array
		private $sub; // Sub navigation array
		private $view; 

		private static $scriptName = 'index.php';
		private static $action = 'a';

		public function __construct(  ) 
		{
			
		}

		/*
		 * @param associative array defined in config.php
		 * @return string
		 */
		public function renderNavigation( array $navItems ) 
		{
			$html = '<ul>';
			foreach ($navItems as $item) {
				$action = $item->getAction();
				$url = $item->getUrl();
				
				if(isset($action)) {
					$url = $url . '?' . self::$action . '=' . $action;
				}

				$completeUrl = $this->createUrl($url);
				$html .= "<li><a href='" . $completeUrl . "' title='" . $item->getText() . "'>" . $item->getText() . "</a></li>";
			}
			$html .= '</ul>';
			return $html;
		}


		public function whichUrlIsUserVisiting( ) 
		{
			$baseUrl = $this->getBaseUrl();

			$completeUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			
			// Get quiery if any and strip it away from url to get only the url left
			$query = parse_url($completeUrl);
			
			if(isset($query['query'])) {
				$query = $query['query'];

				// Plus 1 as we want to strip away the questionmark as well
				$query = strlen($query) + 1;
				$completeUrl = substr($completeUrl, 0 ,-$query);	
			}

			// Isolate the unique part of the url
			$charactersToStripAway = strlen($completeUrl) - strlen($baseUrl);
			$lengthOfRequestedUrl = strlen($completeUrl) - $charactersToStripAway;
			$requestedUrl = $url = substr($completeUrl, $lengthOfRequestedUrl , $charactersToStripAway);
			
			return $requestedUrl;
		}

		public function whichActionIsRequested() 
		{
			if(isset($_GET[self::$action])) {
				return $_GET[self::$action];
			}
		}

		/*
		 * @param $url string
		 * @return string
		 */
		private function createUrl( $url ) 
		{
			$baseUrl = $this->getBaseUrl();
			$url = $baseUrl . $url;
			return $url;
		}

		/*
		 * @return string
		 */
		private function getBaseUrl() 
		{
			$host = $_SERVER['HTTP_HOST'];
			$url = $_SERVER['SCRIPT_NAME'];
			$charactersToStripAway = strlen($url) - strlen(self::$scriptName);
			$url = substr($url, 0, $charactersToStripAway);

			$completeUrl = "http://" . $host . $url;

			return $completeUrl;
		}

}