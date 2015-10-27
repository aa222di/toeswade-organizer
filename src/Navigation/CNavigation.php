<?php

namespace Toeswade\Navigation; 
	
class CNavigation 
{

		private $view; 
		private $navigationMenu;

		public function __construct() 
		{

			$this->view = new VNavigation();
			$this->navigationMenu = new NavigationMenu();
			
		}


		/*
		 * @return object
		 */
		public function getPageController() 
		{
			$url = $this->view->whichUrlIsUserVisiting();
			$controller = $this->navigationMenu->getController( $url );

			return $controller;
		}

		/*
		 * @return string
		 */
		public function getPageAction() 
		{
			$action = $this->view->whichActionIsRequested();
			return $action;
		}


		/*
		 * @return string
		 */
		public function getParams() 
		{
			$params = $this->view->getParams();
			return $params;
		}

		/*
		 * @return string
		 */
		public function addNavigationItem( NavItem $itemToAdd ) 
		{
			$this->navigationMenu->addItem( $itemToAdd );
		}

		/*
		 * @return string
		 */
		public function getMainNavigation() 
		{
			$navItemsArray = $this->navigationMenu->getNavigationItems();
			$mainNav = $this->view->renderNavigation($navItemsArray);
			return $mainNav;
		}

}