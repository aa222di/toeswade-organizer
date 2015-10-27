<?php

namespace Toeswade\Customer; 
	
class CustomerCatalogue
{

		private $db;
		private $catalogue;
		private $successAddingCustomer;
		private $successUpdatingCustomer;
		private $successDeletingCustomer;
		private $successResetingDatabase;


		private static $dbTable = 'Customers';


		/* 
		 * Create the customer database if there is none. Gets customers from database and converts them into Customer objects.
		 * @return void
		 */
		public function __construct($db) 
		{

			// Connect to a database
			$this->db = $db;

			// Set variables
			$this->successAddingCustomer   = false;
			$this->successUpdatingCustomer = false;
			$this->successDeletingCustomer = false;
			$this->successResetingDatabase = false;

			// Create table for customers
			$this->initDatabase();

    		// Get all customers as NewCustomer objects
    		$stmt = $this->db->db->prepare("SELECT * FROM " . self::$dbTable);
    	

    		try {
				$stmt -> execute();
    			$this->catalogue = $stmt->fetchAll(\PDO::FETCH_CLASS, '\Toeswade\Customer\NewCustomer');
			}
			catch(\PDOException $e) {
    			print "Error!: " . $e->getMessage();
		    	die();//Remove or change message in production code
    		}

    		// Convert them into Customer objects 
    		foreach ( $this->catalogue as $key => $NewCustomerObject ) {
    			
    			try {
					$this->catalogue[$key] = new Customer($NewCustomerObject);
				}
				catch(\Exception $e) {
    				echo "Error:" . $e->getMessage();
    			}
    		}
		}

		// GETTERS AND CHECKERS

		/*
		 * @return array of \Toeswade\Customer objects
		 */
		public function getCustomerCatalogue()
		{
			return $this->catalogue;
		}


		/*
		 * @param $id int, customer id
		 * @return \Toeswade\Customer object
		 */
		public function getCustomer($id)
		{
			foreach ( $this->catalogue as $key => $customer ) {
				if($id == $customer->getId()) {
					$requestedCustomer = $customer;
				}
    		}
    		if(isset($requestedCustomer)) {
    			return $requestedCustomer;
    		}
		}

		/*
		 * @return boolean
		 */
		public function wasCustomerSuccessfullyAdded()
		{
			return $this->successAddingCustomer;
		}

		/*
		 * @return boolean
		 */
		public function wasCustomerSuccessfullyUpdated()
		{
			return $this->successUpdatingCustomer;
		}

		/*
		 * @return boolean
		 */
		public function wasCustomerSuccessfullyDeleted()
		{
			return $this->successDeletingCustomer;
		}

		/*
		 * @return boolean
		 */
		public function wasCustomerDatabaseSuccessfullyReset()
		{
			return $this->successResetingDatabase;
		}


		// PUBLIC CRUD METHODS

		/*
		 * Checks if there more than one customer with the same name, if so, throw exception
		 * If not, updates customer
		 * @return void
		 */
		public function updateCustomer( Customer $customerToUpdate )
		{
			// Check if there's a customer with this id
			foreach ($this->catalogue as $key => $customer) {
				if($customer->getFullName() == $customerToUpdate->getFullName() && $customer->getId() != $customerToUpdate->getId()) {
					throw new \Toeswade\Exceptions\CustomerExistsException('Customer with equal name already exists');
				}
				else {
					if($customer->getId() == $customerToUpdate->getId()) {
					$this->updateDatabase( $customerToUpdate );
					$this->catalogue[$key] =  $customerToUpdate;
					$this->successUpdatingCustomer = true;
					}
				}
			}

			if(!$this->successUpdatingCustomer) {
				throw new \Toeswade\Exceptions\CustomerDoesNotExistException('Customer with id: ' . $customerToUpdate->getId() . ' does not exist');	
			}
		}


		/*
		 * Checks if there more than one customer with the same name
		 * If not, adds customer to database and catalogue
		 * @return void
		 */
		public function addCustomer( Customer $customerToAdd )
		{
			foreach ($this->catalogue as $key => $customer) {
				if($customer->getFullName() == $customerToAdd->getFullName()) {
					throw new \Toeswade\Exceptions\CustomerExistsException('Customer with equal name already exists');
				}
			}
		
			$this->addToDatabase($customerToAdd);
			$this->catalogue[] = $customerToAdd;
			$this->successAddingCustomer = true;
		}

		/*
		 * Checks if there more than one customer with the same name
		 * If not, adds customer to database and catalogue
		 * @return void
		 */
		public function deleteCustomer( Customer $customerToDelete )
		{
			foreach ($this->catalogue as $key => $customer) {
				if($customer->getId() == $customerToDelete->getId()) {
					$this->deleteCustomerFromDatabase( $customerToDelete );
					unset($this->catalogue[$key]);
					$this->successDeletingCustomer = true;
				}
			}

			if(!$this->successDeletingCustomer) {
				throw new \Toeswade\Exceptions\CustomerDoesNotExistException('Customer with id: ' . $customerToUpdate->getId() . ' does not exist');	
			}

		}


		/*
		 * Resets the database to empty
		 */
		public function resetCustomerDatabase( )
		{
			try {
				$this->resetDatabase();
				$this->initDatabase();
				$this->successResetingDatabase = true;
			} catch(\Exception $e) {
				return $e->getMessage();
			}

		}


		// DATABASE ACCESS METHODS

		/*
		 * Adds a customer to the database
		 * @param customerToAdd, Customer Obj.
		 */
		private function addToDatabase( Customer $customerToAdd )
		{
			$stmt = $this->db->db->prepare("INSERT INTO " . self::$dbTable . "  (name, surname, telephone, email) VALUES (:name, :surname, :telephone, :email)");
			
			$name 		= $customerToAdd->getName();
			$surname 	= $customerToAdd->getSurname();
			$telephone 	= $customerToAdd->getTelephone();
			$email 		= $customerToAdd->getEmail();

			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':surname', $surname);
			$stmt->bindParam(':telephone', $telephone);
			$stmt->bindParam(':email', $email);
	
			try {
				$stmt -> execute();
			} 	catch(\PDOException $e) {
    			print "Error!: " . $e->getMessage();
		    	die();//Remove or change message in production code
    		}
		}

		/*
		 * Updates a customer in the database
		 * @param customerToUpdate, Customer Obj.
		 */
		private function updateDatabase( Customer $customerToUpdate )
		{
			$stmt = $this->db->db->prepare("UPDATE " . self::$dbTable . " SET `name`= :name, `surname`= :surname, `telephone`= :telephone, `email`= :email WHERE `id`=:id");
			
			$name 		= $customerToUpdate->getName();
			$surname 	= $customerToUpdate->getSurname();
			$telephone 	= $customerToUpdate->getTelephone();
			$email 		= $customerToUpdate->getEmail();
			$id 		= $customerToUpdate->getId();

			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':surname', $surname);
			$stmt->bindParam(':telephone', $telephone);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':id', $id);
	
			try {
				$stmt -> execute();
			} 	catch(\PDOException $e) {
    			print "Error!: " . $e->getMessage();
		    	die();//Remove or change message in production code
    		}
		}

		/*
		 * Deletes a customer from the database
		 * @param customerToAdd, Customer Obj.
		 */
		private function deleteCustomerFromDatabase( Customer $customerToDelete )
		{
			$stmt = $this->db->db->prepare("DELETE FROM " . self::$dbTable . " WHERE `id`=:id");
			
			$id 		= $customerToDelete->getId();
			$stmt->bindParam(':id', $id);
	
			try {
				$stmt -> execute();
			} 	catch(\PDOException $e) {
    			print "Error!: " . $e->getMessage() . "<br/>";
		    	die();//Remove or change message in production code
    		}
		}

		/*
		 * Initiates the table for customers if not exists
		 */
		private function initDatabase()
		{
			// Create table for customers
			$sql = "CREATE TABLE IF NOT EXISTS " . self::$dbTable . " (
					  `id` INT NOT NULL AUTO_INCREMENT,
					  `name` VARCHAR(20) NOT NULL,
					  `surname` VARCHAR(45) NOT NULL,
					  `telephone` VARCHAR(11) NOT NULL,
					  `email` VARCHAR(60) NOT NULL,
					  PRIMARY KEY (`id`),
					  UNIQUE INDEX `id_UNIQUE` (`id` ASC));";
			try {
				$this->db->db->exec($sql);
			}
			catch(\PDOException $e) {
   				echo $e->getMessage(); //Remove or change message in production code
   			}
		}

		/*
		 * Deletes the whole customer table if exists
		 */
		private function resetDatabase()
		{
			$stmt = $this->db->db->prepare('DROP TABLE IF EXISTS ' . self::$dbTable . '');
			
			try {
				$stmt -> execute();
			} 	catch(\PDOException $e) {
    			print "Error!: " . $e->getMessage() . "<br/>";
		    	die();//Remove or change message in production code
    		}
		}



}