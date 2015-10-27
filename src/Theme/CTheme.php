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
		 * Indexes app and get controller and action to render page
		 * @return void, but calls to view which returns string.
		 */
		public function index() {

			$controller = $this->nav->getPageController();
			if(isset($controller) && is_object($controller)) {
				assert($controller instanceof \Toeswade\IController);

				$action = $this->nav->getPageAction();
				$params = $this->nav->getParams();
				
				if(isset($action)) {
					$view = $controller->$action($params);
					
				}
				else {
					$view = $controller->index();
				}

				$main = $view->getHTML();
				$title = $view->getTitle();

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