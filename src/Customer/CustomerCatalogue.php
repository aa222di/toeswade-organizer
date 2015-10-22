<?php

namespace Toeswade\Customer; 
	
class CustomerCatalogue
{

		private $db;
		private $catalogue;

		private static $dbTable = 'Customers';


		public function __construct($db) 
		{

			// Connect to a database
			$this->db = $db;

			// Create table for users
			$sql = "CREATE TABLE IF NOT EXISTS " . self::$dbTable . " (
					  `id` INT NOT NULL AUTO_INCREMENT,
					  `name` VARCHAR(20) NOT NULL,
					  `surname` VARCHAR(45) NOT NULL,
					  `telephone` INT NOT NULL,
					  `email` VARCHAR(60) NOT NULL,
					  PRIMARY KEY (`id`),
					  UNIQUE INDEX `id_UNIQUE` (`id` ASC));";
				try {
					$this->db->db->exec($sql);
				}
				catch(\PDOException $e) {
    				echo $e->getMessage();//Remove or change message in production code
    			}

    		// Get all customers as NewCustomer objects
    		$stmt = $this->db->db->prepare("SELECT * FROM " . self::$dbTable);
    		$stmt -> execute();
    		$this->catalogue = $stmt->fetchAll(\PDO::FETCH_CLASS, '\Toeswade\Customer\NewCustomer');

    		// Convert them into Customer objects 
    		foreach ( $this->catalogue as $key => $NewCustomberObject ) {
    			$this->catalogue[$key] = new Customer($NewCustomberObject);
    		}
		}

		public function getCustomerCatalogue()
		{
			return $this->catalogue;
		}


		public function addCustomer( Customer $customerToAdd )
		{
			foreach ($this->catalogue as $customer) {
				if($customer->getFullName() == $customerToAdd->getFullName()) {
					throw new \Exception('Customer with equal name already exists');
				}
			}
		
			$this->addToDatabase($customerToAdd);
			$this->catalogue[] = $customerToAdd;
		}




		public function addToDatabase( Customer $customerToAdd )
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
    			print "Error!: " . $e->getMessage() . "<br/>";
		    	die();//Remove or change message in production code
    		}
		}



}