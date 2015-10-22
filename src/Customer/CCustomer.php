<?php

namespace Toeswade\Customer; 
	
class CCustomer implements \Toeswade\ICRUD
{


	private $db;
	private $view;
	private $CustomerCatalogue;

	public function __construct(\Toeswade\Database\Database $db) 
	{
		$this->db = $db;
		$this->view = new VCustomer();
		$this->CustomerCatalogue = new CustomerCatalogue($db);
		
	}


	/*
	 *	Will create new content of some sort, or at least show create view
	 */
    public function index()
    {
    	return $this->read();
    }

	/*
	 *	Will create new content of some sort, or at least show create view
	 */
    public function create()
    {
    	if($this->view->hasFormBeenPosted()) {

    		// Get a NewCustomer object from view
    		$customerToConvert = $this->view->getNewCustomerInfo();

    		// Try to convert it into a "real" customer
    		try {
    			$newCustomer = new Customer($customerToConvert);
    		} catch (\Exception $e) {
    			return $e->getMessage();
    		}

    		// If success - try to add it to customer catalogue
    		if(is_object($newCustomer)) {

    			try {
    				$this->CustomerCatalogue->addCustomer($newCustomer);
    			} catch (\Exception $e) {
    				return $e->getMessage();
    			}

    			$this->view->setSuccessCreateMessage();
    			return $this->read();
    		}
    	}
    	else {
    		$form = $this->view->getCreateForm();
    		return $form;
    	}
    }

    /*
	 *	Will read content
	 */
    public function read()
    {
    	$cat = $this->CustomerCatalogue->getCustomerCatalogue();
    	$list = $this->view->listAllCustomers($cat);
    	return $list;
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