<?php

namespace Toeswade\Customer; 
	
class Customer
{

		private $name;
		private $surname;
		private $telephone;
		private $email;
		private $id;

		public function __construct( NewCustomer $customerToAdd ) 
		{
			if(is_string($customerToAdd->getName()) && strlen(trim($customerToAdd->getName())) > 1) {
				$this->name = $customerToAdd->getName();
			}
			else {
				throw new \Toeswade\Exceptions\TooShortCustomerNameException('Name has to be string and at least 2 characters long');
			}

			if(is_string($customerToAdd->getSurname()) && strlen(trim($customerToAdd->getSurname())) > 1) {
				$this->surname = $customerToAdd->getSurname();
			}
			else {
				throw new \Toeswade\Exceptions\TooShortCustomerSurnameException('Surname has to be string and at least 2 characters long');
			}


			if( ctype_digit( $customerToAdd->getTelephone() ) && preg_match_all( "/[0-9]/", trim($customerToAdd->getTelephone())) >= 8 ) {
				$this->telephone = $customerToAdd->getTelephone();
			}
			else {
				throw new \Toeswade\Exceptions\WrongCustomerTelephoneException('Telephone is has to be number and at least 8 digits long');
			}

			if(filter_var($customerToAdd->getEmail(), FILTER_VALIDATE_EMAIL)) {
				$this->email = $customerToAdd->getEmail();
			}
			else {
				throw new \Toeswade\Exceptions\WrongCustomerEmailException('Email has to be a valid email adress, i.e. name@host.com');
			}

			if($customerToAdd->getId()) {
				$this->id = $customerToAdd->getId();
			}

		}


		// GETTERS

		public function getName() 
		{
			return $this->name;
		}


		public function getSurname() 
		{
			return $this->surname;
		}

		
		public function getTelephone() 
		{
			return $this->telephone;
		}

		public function getEmail() 
		{
			return $this->email;
		}

		
		public function getId() 
		{
			return $this->id;
		}

		public function getFullName() 
		{
			return $this->name . ' ' . $this->surname;
		}



}