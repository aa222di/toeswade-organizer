<?php

namespace Toeswade\Theme; 
	
class CTheme 
{

		private $theme;
		private $nav;
		private $db;
		private $view;


		/*
		 * @param associative array $config
		 * @return void
		 */
		public function __construct(  $path ,\Toeswade\Database\Database $db , \Toeswade\Navigation\CNavigation $nav ) 
		{
	
				$this->nav = $nav;
				$this->db  = $db;
				$this->view = new VTheme($path);
			
			
		}

		/*
		 *
		 *
		 */
		public function indexAction() {

			$controller = $this->nav->getPageController();
			if(isset($controller) && is_object($controller)) {

				$action = $this->nav->getPageAction();
				
				if(isset($action)) {
					$main = $controller->$action();
					$title = $main;
				}
				else {
					$main = $controller->index();
					$title = $main;
				}

			}

			else {
				$main = 'default';
				$title = $main;
			}

			$this->view->setTitle($title);
			$this->view->setMain($main);
			$this->view->setNav($this->nav->getMainNavigation());

			$this->view->render();
		}

}