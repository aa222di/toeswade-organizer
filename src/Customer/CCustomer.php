<?php

namespace Toeswade\Customer; 
	
class CCustomer implements \Toeswade\IController
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
	 * Dispatches to default action
     * @return string
	 */
    public function index()
    {
    	return $this->read();
    }

	/*
	 * Gets the create form from the view and send user input to model to try to create new customer object
     * @return string
	 */
    public function create()
    {
    	if($this->view->hasCreateFormBeenPosted()) {

    		// Get a NewCustomer object from view
    		$customerToConvert = $this->view->getFormInfo();

    		// Try to convert it into a Customer object
    		try {
    			$newCustomer = new Customer($customerToConvert);
    		} catch (\Exception $e) {
    			$this->view->setErrorMessage($e);
    		}

    		// If success - try to add it to customer catalogue
    		if(isset($newCustomer) && is_object($newCustomer)) {

        

    			try {
                    $this->CustomerCatalogue->addCustomer($newCustomer);
    			} catch (\Exception $e) {
    				$this->view->setErrorMessage($e);
    			}

                if($this->CustomerCatalogue->wasCustomerSuccessfullyAdded()) {
                $this->view->setSuccessCreateMessage();

                // Redirect to customer listing
                $controller = new CCustomer($this->db);
                $nav = new \Toeswade\Navigation\NavItem('Customers', 'customers', $controller,  'read');

                \Toeswade\Navigation\VNavigation::redirectTo($nav);

                }

    		}
    	}

    	$form = $this->view->getCreateForm();
    	return $form;
    	
    }

    /*
	 * Gets the customer catalogue and injects it into the view
     * @return string
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
    public function update($id)
    {
        if($this->view->hasUpdateFormBeenPosted()) {

            $customerToUpdate = $this->view->getFormInfo();
            $customerToUpdate->setId($id);

            // Try to convert it into a Customer object to check that new info is valid for customer
            try {
                $customer = new Customer($customerToUpdate);
            } catch (\Exception $e) {
                $this->view->setErrorMessage($e);
            }
            
            if(isset($customer) && is_object($customer)) {
                try {
                    $this->CustomerCatalogue->updateCustomer($customer);
                } catch (\Exception $e) {
                    $this->view->setErrorMessage($e);
                }

                if($this->CustomerCatalogue->wasCustomerSuccessfullyUpdated()) {
                    $this->view->setSuccessUpdateMessage();
                }
            }
        }

        $customer = $this->CustomerCatalogue->getCustomer($id);
        $form = $this->view->getUpdateForm($customer);
        return $form;
    }

    /*
	 *	Will delete content or at least show delete view
	 */
    public function delete($id)
    {
        $customer = $this->CustomerCatalogue->getCustomer($id);

        if($this->view->hasDeleteFormBeenPosted()) {
            try {
                $this->CustomerCatalogue->deleteCustomer( $customer );
            } catch (\Exception $e) {
                $this->view->setErrorMessage($e);
            }

            if($this->CustomerCatalogue->wasCustomerSuccessfullyDeleted()) {
                $this->view->setSuccessDeleteMessage( $customer->getFullname() );
                // Redirect to customer listing
                $controller = new CCustomer($this->db);
                $nav = new \Toeswade\Navigation\NavItem('Customers', 'customers', $controller,  'read');

                \Toeswade\Navigation\VNavigation::redirectTo($nav);
            }
            
        }

       
        $form = $this->view->getDeleteForm($customer);
        return $form;
    }

    /*
     *  Resets the database
     */
    public function reset()
    {
        if($this->view->hasResetFormBeenPosted()) {
            try {
                $this->CustomerCatalogue->resetCustomerDatabase();
            } catch (\Exception $e) {
                $this->view->setErrorMessage($e);
            }

            if($this->CustomerCatalogue->wasCustomerDatabaseSuccessfullyReset()) {
                $this->view->setSuccessResetMessage();
                // Redirect to customer listing
                $controller = new CCustomer($this->db);
                $nav = new \Toeswade\Navigation\NavItem('Customers', 'customers', $controller,  'read');

                \Toeswade\Navigation\VNavigation::redirectTo($nav);
            }
            
        }

       
        $form = $this->view->getResetForm();
        return $form;
    }



}