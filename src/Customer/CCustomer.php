<?php

namespace Toeswade\Customer; 
	
class CCustomer implements \Toeswade\ICRUD
{


	private $db;

	public function __construct(\Toeswade\Database\Database $db) 
	{
		$this->db = $db;
		
	}


	/*
	 *	Will create new content of some sort, or at least show create view
	 */
    public function index()
    {
    	return 'index';
    }

	/*
	 *	Will create new content of some sort, or at least show create view
	 */
    public function create()
    {
    	return 'create';
    }

    /*
	 *	Will read content
	 */
    public function read()
    {
    	return 'read';
    }

    /*
	 *	Will update content or at least show edit view
	 */
    public function update()
    {

    }

    /*
	 *	Will delete content or at least show delete view
	 */
    public function delete()
    {

    }



}