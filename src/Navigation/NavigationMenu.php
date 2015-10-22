<?php

namespace Toeswade\Navigation; 
	
class NavigationMenu
{

		private $navItems; 


		public function __construct() 
		{
			$this->navItems = array();
		}

		public function addItem( NavItem $itemToAdd ) 
		{
			$this->navItems[] = $itemToAdd;
		}


		public function getNavigationItems() 
		{
			return $this->navItems;
		}

		public function getController( $url ) 
		{
			foreach ($this->navItems as $item) {
				if($item->getUrl() == $url) {
					return $item->getController();
				}
			}
		}


}