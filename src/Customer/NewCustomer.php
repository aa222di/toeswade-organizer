<?php

namespace Toeswade\Customer; 
	
class NewCustomer
{

		private $name;
		private $surname;
		private $telephone;
		private $email;
		private $id;

		public function __construct($name=null, $surname=null, $telephone=null, $email=null, $id=null) 
		{

			// Objects of this class are both created from PDO::FETCH_CLASS and manually
			// therefore it is necessarry to check how to set the member variables.
			if(!isset($this->id)) {
				$this->name 	 = $name;
				$this->surname   = $surname;
				$this->telephone = $telephone;
				$this->email 	 = $email;
			}

		}

		// GETTERS

		public function getName() 
		{
			$this->name = strip_tags(trim($this->name));
			return $this->name;
		}


		public function getSurname() 
		{
			$this->surname = strip_tags(trim($this->surname));
			return $this->surname;
		}

		
		public function getTelephone() 
		{	
			$this->telephone = trim($this->telephone);
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

		// SETTERS

		public function setId($id) 
		{
			assert(is_numeric($id));
			$this->id = $id;
		}



}