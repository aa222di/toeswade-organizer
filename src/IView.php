<?php

/*	
 * IView - basic pattern for all Views in this project. That is all classes with the prefix V
 */

namespace Toeswade;

interface IView
{	
	/*
	 *	Render selected view
	 */
    public function getHTML();

    /*
	 *	Get the title for the page
	 */
    public function getTitle();
}