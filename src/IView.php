<?php

/*	
 * IView - basic pattern for all Views in this project. That is all classes with the prefix V
 */

namespace Toeswade;

interface IView
{	
	/*
	 *	Render selected view with the specified theme
	 */
    public function getHTML($theme);
}