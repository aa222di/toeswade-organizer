<?php

namespace Toeswade\Navigation; 
	
class VNavigation 
{

		private $main; // Main navigation array
		private $sub; // Sub navigation array
		private $view; 

		private static $scriptName = 'index.php';
		private static $action = 'a';
		private static $params = 'p';
		private static $navItemStorageInSession = 'VNavigation::NavItemStorage';

		public function __construct(  ) 
		{
			assert(isset($_SESSION));
		}

		// PUBLIC STATIC METHODS TO HELP CREATE LINKS IN APP
		/*
		 * Creates a link which will redirect to new action on same controller
		 * @return string
		 */
		public static function createActionLink( $action, $params=null ) 
		{
			$nav = new VNavigation();
			$url =  $nav->getUrlWithoutQuery();
			if(isset($action)) {
				$url = $url . '?' . self::$action . '=' . $action;
			}
			if(isset($params)) {
				$url = $url . '&' . self::$params . '=' . $params;
			}
			return $url;

		}

		/*
		 * Redirects to other page in app. 
		 * Important: $controller needs to be registered before hand
		 */
		public static function redirectTo( NavItem $whereTo) 
		{
			$nav = new VNavigation();
			$url = $nav->getUniqueUrl( $whereTo);
			$completeUrl = $nav->createUrl($url);
			header('Location: ' . $completeUrl);
			exit();

		}

		// PUBLIC METHODS

		/*
		 * @param associative array defined in config.php
		 * @return string
		 */
		public function renderNavigation( array $navItems ) 
		{

			$html = '<ul>';
			foreach ($navItems as $item) {
				$url = $this->getUniqueUrl( $item ); 

				$completeUrl = $this->createUrl( $url );
				$html .= "<li><a href='" . $completeUrl . "' title='" . $item->getText() . "'>" . $item->getText() . "</a></li>";
			}
			$html .= '</ul>';
			return $html;
		}

		/*
		 * @return string - requested url
		 */
		public function whichUrlIsUserVisiting( ) 
		{
			$baseUrl = $this->getBaseUrl();

			$completeUrl = $this->getUrlWithoutQuery();

			// Isolate the unique part of the url
			$charactersToStripAway = strlen($completeUrl) - strlen($baseUrl);
			$lengthOfRequestedUrl = strlen($completeUrl) - $charactersToStripAway;
			$requestedUrl = $url = substr($completeUrl, $lengthOfRequestedUrl , $charactersToStripAway);
			
			return $requestedUrl;
		}




		/*
		 * @return string, action to be called on controller
		 */
		public function whichActionIsRequested() 
		{
			if(isset($_GET[self::$action])) {
				return $_GET[self::$action];
			}
		}

		/*
		 * @return string, params
		 */
		public function getParams() 
		{
			if(isset($_GET[self::$params])) {
				return $_GET[self::$params];
			}
		}

		// PRIVATE METHODS

		/*
		 * Puts together the base url and the unique url for requested page
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
		 * Gets the base url for the site
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

		/*
		 * puts together url, action and params
		 * @return string
		 */
		private function getUniqueUrl( NavItem $item ) 
		{		
				$url = $item->getUrl();
				$action = $item->getAction();
				$params = $item->getParams();
				
				if(isset($action)) {
					$url = $url . '?' . self::$action . '=' . $action;
				}
				if(isset($params)) {
					$url = $url . '&' . self::$params . '=' . $params;
				}

				return $url;
		}

		/*
		 * @return string, url without query
		 */
		private function getUrlWithoutQuery() 
		{		
			$completeUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			
			// Get quiery if any and strip it away from url to get only the url left
			$query = parse_url($completeUrl);
			
			if(isset($query['query'])) {
				$query = $query['query'];

				// Plus 1 as we want to strip away the questionmark as well
				$query = strlen($query) + 1;
				$completeUrl = substr($completeUrl, 0 ,-$query);	
			}

				return $completeUrl;
		}

}