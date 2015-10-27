<?php

/*	
 * ICRUD- basic pattern for all CRUD Controllers in this project. These controllers return the create, read, update and delete view from their module
 */

namespace Toeswade;

interface IController
{	

	/*
	 *	Will be called if no action is specified
	 */
    public function index();
    
}