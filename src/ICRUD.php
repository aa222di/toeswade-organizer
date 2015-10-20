<?php

/*	
 * ICRUD- basic pattern for all CRUD Controllers in this project. These controllers return the create, read, update and delete view from their module
 */

namespace Toeswade;

interface ICRUD
{	
	/*
	 *	Will create new content of some sort, or at least show create view
	 */
    public function createAction();

    /*
	 *	Will read content
	 */
    public function readAction();

    /*
	 *	Will update content or at least show edit view
	 */
    public function updateAction();

    /*
	 *	Will delete content or at least show delete view
	 */
    public function deleteAction();
}