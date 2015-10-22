<?php

/*	
 * ICRUD- basic pattern for all CRUD Controllers in this project. These controllers return the create, read, update and delete view from their module
 */

namespace Toeswade;

interface ICRUD
{	

	/*
	 *	Will be called if no action is specified
	 */
    public function index();

	/*
	 *	Will create new content of some sort, or at least show create view
	 */
    public function create();

    /*
	 *	Will read content
	 */
    public function read();

    /*
	 *	Will update content or at least show edit view
	 */
    public function update();

    /*
	 *	Will delete content or at least show delete view
	 */
    public function delete();
}