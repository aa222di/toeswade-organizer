<?php

namespace Toeswade\Customer; 
	
class VCustomer 
{
		// Customer 
		private $name;
		private $surname;
		private $telephone;
		private $email;

		// Messages
		private $successCreateMessage;

		// POST VARIABLES
		private static $postName 			= 'VCustomer::name';
		private static $postSurname 		= 'VCustomer::surname';
		private static $postTelephone		= 'VCustomer::telephone';
		private static $postEmail 			= 'VCustomer::email';
		private static $postCreateCustomer 	= 'VCustomer::create';


		public function __construct(  ) 
		{
			
		}

		public function getCreateForm() 
		{
			$form = $this->renderHTMLForCreateForm();
			return $form;
		}

		public function listAllCustomers( array $catalogue ) 
		{
			$html = '<table><thead><tr><th>Name</th><th>Surname</th><th>Telephone</th><th>Email</th></tr></thead><tbody>';
			foreach ($catalogue as $key => $customer) {
				assert($customer instanceof Customer);
				$html .= '<tr>';
				$html .= '<td>' . $customer->getName() . '</td>';
				$html .= '<td>' . $customer->getSurname() . '</td>';
				$html .= '<td>' . $customer->getTelephone() . '</td>';
				$html .= '<td>' . $customer->getEmail() . '</td>';
				$html .= '<tr>';
			}
			$html .= '</tbody></table>';

			return $html;
		}

		public function setSuccessCreateMessage() 
		{
			$this->successCreateMessage = 'Customer was successfully added to catalogue';
		}


		public function getNewCustomerInfo() 
		{
			$this->name 	 = $_POST[self::$postName];
			$this->surname   = $_POST[self::$postSurname];
			$this->telephone = $_POST[self::$postTelephone];
			$this->email 	 = $_POST[self::$postEmail];

			$newCustomer = new NewCustomer($this->name, $this->surname, $this->telephone, $this->email);

			return $newCustomer;
		}


		public function hasFormBeenPosted() 
		{
			if(isset($_POST[self::$postCreateCustomer])) {
				return true;
			}
			else {
				return false;
			}
		}

		public function renderHTMLForCreateForm() 
		{
			return 
				'<form method="post" class="create-customer"> 
					<fieldset>
						<legend>Add new customer</legend>
									
						<label for="' . self::$postName . '">Name:</label>
						<input type="text" id="' . self::$postName . '" name="' . self::$postName . '" value="' .  $this->name . '" />

						<label for="' . self::$postSurname . '">Surname:</label>
						<input type="text" id="' . self::$postSurname . '" name="' . self::$postSurname . '" value="' . $this->surname . '" />

						<label for="' . self::$postTelephone . '">Telephone:</label>
						<input type="text" id="' . self::$postTelephone . '" name="' . self::$postTelephone . '" value="' . $this->telephone . '" />
							
						<label for="' . self::$postEmail . '">Email:</label>
						<input type="text" id="' . self::$postEmail . '" name="' . self::$postEmail . '" value="' . $this->email . '" />

						<input type="submit" name="' .  self::$postCreateCustomer . '" value="Add customer" />
					</fieldset>
				</form>';

		}



}