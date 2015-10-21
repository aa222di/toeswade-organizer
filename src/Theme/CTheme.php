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
		public function __construct( array $config ) 
		{
			if(isset($config['theme']) && isset($config['database']) && isset($config['navigation'])) {
				extract($config);
				$this->nav = new \Toeswade\Navigation\CNavigation($navigation);
				$this->db  = new \Toeswade\Database\Database($database);
				$this->theme = $theme;
				$this->view = new VTheme($theme);
			}

			else {
				throw new \Exception('Config file is not complete');
			}
			
		}

		/*
		 *
		 *
		 */
		public function indexAction() {
			$content['main'] = 'main';
			$content['nav']  = $this->nav->getMainNavigation();

			$this->view->render($content);
		}

}