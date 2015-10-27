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
		private $successMessage;
		private $errorMessage;

		// POST VARIABLES
		private static $postName 			= 'VCustomer::name';
		private static $postSurname 		= 'VCustomer::surname';
		private static $postTelephone		= 'VCustomer::telephone';
		private static $postEmail 			= 'VCustomer::email';
		private static $postCreateCustomer 	= 'VCustomer::create';
		private static $postUpdateCustomer 	= 'VCustomer::update';
		private static $postDeleteCustomer 	= 'VCustomer::delete';
		private static $postResetCustomers 	= 'VCustomer::delete';

		// SESSION VARIABLES
		private static $messageStorageInSession 	= 'VCustomer::MessageStorage';


		public function __construct(  ) 
		{
			assert(isset($_SESSION));
		}


		// GET FORMS OR TABLES

		/*
		 * Creates form for adding customer
		 * @return string html
		 */
		public function getCreateForm() 
		{
			$form = $this->renderHTMLForCustomerForm('create');
			return $form;
		}

		/*
		 * Creates form for updating customer
		 * @param customer object to update
		 * @return string html
		 */
		public function getUpdateForm( Customer $customerToUpdate ) 
		{	
			$this->name 	 = $customerToUpdate->getName();
			$this->surname   = $customerToUpdate->getSurname();
			$this->telephone = $customerToUpdate->getTelephone();
			$this->email 	 = $customerToUpdate->getEmail();
			$form = $this->renderHTMLForCustomerForm('update');
			return $form;
		}

		/*
		 * @return string
		 */
		public function getDeleteForm(Customer $customerToDelete) 
		{
			$link = \Toeswade\Navigation\VNavigation::createActionLink('read');
			$form ='<form method="post" class="delete-customer"> 
					<fieldset>
						<legend>Are you sure you want to delete customer: ' . $customerToDelete->getFullname() . '</legend>
							<a href="' . $link . '" title="List all customers">No, go back to customer lisitng</a>
							<input type="submit" name="' .  self::$postDeleteCustomer . '" value="Yes, delete customer" />
					</fieldset>
				</form>';

			return $this->errorMessage . $form;
		}

		/*
		 * @return boolean
		 */
		public function getResetForm() 
		{
			$link = \Toeswade\Navigation\VNavigation::createActionLink('read');
			$form ='<form method="post" class="reset-customer-database"> 
					<fieldset>
						<legend>Are you sure you want to reset the database?</legend>
							<a href="' . $link . '" title="List all customers">No, go back to customer lisitng</a>
							<input type="submit" name="' .  self::$postResetCustomers . '" value="Yes, reset it!" />
					</fieldset>
				</form>';

			return $this->errorMessage . $form;
		}

		/*
		 * Lists all customers in a table
		 * @param catalogue, array of Customer objects
		 * @return HTML string
		 */
		public function listAllCustomers( array $catalogue ) 
		{
			$message = $this->getMessage();
			$html = '<table><thead><tr><th>Name</th><th>Surname</th><th>Telephone</th><th>Email</th><th>Edit</th><th>Delete</th></tr></thead><tbody>';
			foreach ($catalogue as $key => $customer) {
				assert($customer instanceof Customer);

				$editLink = \Toeswade\Navigation\VNavigation::createActionLink('update', $customer->getId());
				$deleteLink = \Toeswade\Navigation\VNavigation::createActionLink('delete', $customer->getId());

				$html .= '<tr>';
				$html .= '<td>' . $customer->getName() . '</td>';
				$html .= '<td>' . $customer->getSurname() . '</td>';
				$html .= '<td>' . $customer->getTelephone() . '</td>';
				$html .= '<td>' . $customer->getEmail() . '</td>';
				$html .= '<td><a href="' . $editLink . '" title="Edit this customer">Edit</a></td>';
				$html .= '<td><a href="' . $deleteLink . '" title="Delete this customer">Delete</a></td>';
				$html .= '<tr>';
			}
			$html .= '</tbody></table>';

			return $message . $html;
		}


		// SET MESSAGES

		/*
		 * Sets success message for creating customer
		 */
		public function setSuccessCreateMessage() 
		{
			$this->successMessage = 'Customer was successfully added to catalogue';
			$_SESSION[self::$messageStorageInSession] = $this->successMessage;
		}

		/*
		 * Sets success message for updating customer
		 */
		public function setSuccessUpdateMessage() 
		{
			$this->successMessage = 'Customer ' . $this->name . ' ' . $this->surname  . ' was successfully updated';
			$_SESSION[self::$messageStorageInSession] = $this->successMessage;
		}

		/*
		 * @param string customer name, optional
		 * Sets success message for deleting customer
		 */
		public function setSuccessDeleteMessage( $customerName = null) 
		{
			$this->successMessage = 'Customer ' . $customerName  . ' was successfully deleted';
			$_SESSION[self::$messageStorageInSession] = $this->successMessage;
		}


		/*
		 * Sets success message for reseting database
		 */
		public function setSuccessResetMessage() 
		{
			$this->successMessage = 'Customer database was reset successfully and is now empty';
			$_SESSION[self::$messageStorageInSession] = $this->successMessage;
		}

		/*
		 * Checks what kind of exception has been thrown and returns userfriendly message
		 * @return string
		 */
		public function setErrorMessage(\Exception $e) {

			switch($e) {

				case ($e instanceof \Toeswade\Exceptions\TooShortCustomerNameException):
			    	$this->errorMessage = '<p>The customer name has to be string and at least 2 characters long</p>';
			    	break;

			    case ($e instanceof \Toeswade\Exceptions\TooShortCustomerSurnameException):
			    	$this->errorMessage = '<p>The customer surname has to be string and at least 2 characters long</p>';
			    	break;

			    case ($e instanceof \Toeswade\Exceptions\WrongCustomerTelephoneException):
			    	$this->errorMessage = '<p>The telephone number can only contain digits and has to be at least 8 digits long</p>';
			    	break;

			    case ($e instanceof \Toeswade\Exceptions\WrongCustomerEmailException):
			    	$this->errorMessage = '<p>The email adress has to follow following format email@domain.com</p>';
			    	break;

			    case ($e instanceof \Toeswade\Exceptions\CustomerExistsException):
			    	$this->errorMessage = '<p>A customer with the name ' . $this->name . ' ' . $this->surname . ' already exists</p>';
			    	break;

			    case ($e instanceof \Toeswade\Exceptions\CustomerDoesNotExistException):
			    	$this->errorMessage = '<p>A customer with the name ' . $this->name . ' ' . $this->surname . ' does not exist</p>';
			    	break;

			    default:
			    	$this->errorMessage = '<p>Something went wrong</p>';
			    	break;
			}

		}

		// RETRIEVE POST INFO

		/*
		 * Gets user input from form
		 * @return NewCustomer object
		 */
		public function getFormInfo() 
		{
			$this->name 	 = $_POST[self::$postName];
			$this->surname   = $_POST[self::$postSurname];
			$this->telephone = $_POST[self::$postTelephone];
			$this->email 	 = $_POST[self::$postEmail];

			$newCustomer = new NewCustomer($this->name, $this->surname, $this->telephone, $this->email);

			return $newCustomer;
		}

		/*
		 * @return boolean
		 */
		public function hasCreateFormBeenPosted() 
		{
			if(isset($_POST[self::$postCreateCustomer])) {
				return true;
			}
			else {
				return false;
			}
		}


		/*
		 * @return boolean
		 */
		public function hasUpdateFormBeenPosted() 
		{
			if(isset($_POST[self::$postUpdateCustomer])) {
				return true;
			}
			else {
				return false;
			}
		}

		/*
		 * @return boolean
		 */
		public function hasDeleteFormBeenPosted() 
		{
			if(isset($_POST[self::$postDeleteCustomer])) {
				return true;
			}
			else {
				return false;
			}
		}

		/*
		 * @return boolean
		 */
		public function hasResetFormBeenPosted() 
		{
			if(isset($_POST[self::$postResetCustomers])) {
				return true;
			}
			else {
				return false;
			}
		}

		// PRIVATE FUNCTIONS

		/*
		 * @param action, switch between update or create form
		 * @return HTML string form
		 */
		private function renderHTMLForCustomerForm($action) 
		{
			switch($action) {
				case 'create':
					$class = 'create-customer';
					$legend = 'Add new customer';
					$button = '<input type="submit" name="' .  self::$postCreateCustomer . '" value="Add customer" />';
					break;
				case 'update':
					$class = 'update-customer';
					$legend = 'Update ' . $this->name . ' ' . $this->surname;
					$button = '<input type="submit" name="' .  self::$postUpdateCustomer . '" value="Update customer" />';
					break;
			}

			$message = $this->errorMessage;
			if(!isset($message)) {
				$message = $this->getMessage();
			}
			return
				$message . 
				'<form method="post" class="' . $class . '"> 
					<fieldset>
						<legend>' . $legend . '</legend>
									
						<label for="' . self::$postName . '">Name:</label>
						<input type="text" id="' . self::$postName . '" name="' . self::$postName . '" value="' .  $this->name . '" />

						<label for="' . self::$postSurname . '">Surname:</label>
						<input type="text" id="' . self::$postSurname . '" name="' . self::$postSurname . '" value="' . $this->surname . '" />

						<label for="' . self::$postTelephone . '">Telephone:</label>
						<input type="text" id="' . self::$postTelephone . '" name="' . self::$postTelephone . '" value="' . $this->telephone . '" />
							
						<label for="' . self::$postEmail . '">Email:</label>
						<input type="text" id="' . self::$postEmail . '" name="' . self::$postEmail . '" value="' . $this->email . '" />

						' . $button . '
					</fieldset>
				</form>';

		}

		/*
		 * @return string
		 */
		private function getMessage() 
		{
			if( isset($_SESSION[self::$messageStorageInSession]) ) {
				$message = $_SESSION[self::$messageStorageInSession];
				unset($_SESSION[self::$messageStorageInSession]);
				return $message;
			}
			else {
				return '';
			}
		}


}