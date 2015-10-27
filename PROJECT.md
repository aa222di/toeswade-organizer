# Organizer
#### toeswade-organizer | Project for Linnaeus University | Amanda Marie Åberg | 880920




###Supplementary specification
System Quality Requirements
 * The system should respond to input in an acceptable timeframe.
 * The system should be user-friendly
 * System provides helpful error messages
 * System avoids unnecessary input
 * The system should be secure
 * The system should follow web standards.
 * Components should be easy to use with other modules



#UC1 Add customer
##Main scenario
 1. Starts when a user wants to add a customer
 2. System asks for name, surname, telephone and email
 3. User provides name, surname, telephone and email
 4. System adds the customer to the database and presents that it succeeded

#UC2 Update a customer
##Preconditions
UC1, there needs to be a customer in the database
##Main scenario
 1. Starts when a user wants to update a customer
 2. System shows filled in inputfields for name, surname, telephone and email
 3. User changes the fields he/she wants
 4. System updates the customer and presents that it succeeded

#UC3 Delete a customer
##Preconditions
UC1, there needs to be a customer in the database
##Main scenario
 1. Starts when a user wants to delete a customer
 2. System asks user if he/she is sure that customer should be deleted
 3. User chooses to delete customer
 4. System deletes the customer and presents that it succeeded

#UC4 List all customers
##Preconditions
UC1, there needs to be a customer in the database
##Main scenario
 1. Starts when a user wants to list all customers
 2. User chooses the link "Customers"
 3. System shows all the customers in the database as a table

# Testcases

##Test case 1.1, Navigate to Page 
Normal navigation to page, page is shown.

###Input:
 * Clear existing cookies
 * Navigate to site.
 
###Output:
 * A menu is show with four alternatives Start, Customers, Add customer, Reset database.
 * A header and footer is shown
 * The body text says "default"
 

##Test case 1.2: Reset database
Start test by reseting the database

###Input:
 * Testcase 1.1
 * Navigate to the link Reset database
 * Press "Yes, reset it!"
 
###Output:
 * The text "Customer database was reset successfully and is now empty", is shown.
 * A empty table is shown

***

##Test case 2.1: Navigate to Add customer
Make sure navigation works and shows an empty form for adding customer

###Input:
 * Testcase 1.1
 * Click the link "Add customer"
 
###Output:
 * A form for adding customer is shown


##Test case 2.2: Failed adding customer without name
Make sure customer can't be added without a name

###Input:
 * Testcase 2.1
 * Press "Add customer" button
 
###Output:
 * The text "The customer name has to be string and at least 2 characters long", is shown.
 * A form for adding customer is shown
 * All fields are empty



##Test case 2.3: Failed adding customer without surname
Make sure customer can't be added without a surname

###Input:
 * Testcase 2.1
 * Fill in a name for the customer, i.e. "Test"
 * Press "Add customer" button
 
###Output:
 * The text "The customer surname has to be string and at least 2 characters long", is shown.
 * A form for adding customer is shown
 * The field for name is filled in with "Test"
 * All other fields are empty



##Test case 2.4: Failed adding customer without a telephone number
Make sure customer can't be added without a telephone number

###Input:
 * Testcase 2.1
 * Fill in a name for the customer, i.e. "Test"
 * Fill in a surname for the customer, i.e. "Testsson"
 * Press "Add customer" button
 
###Output:
 * The text "The telephone number can only contain digits and has to be at least 8 digits long", is shown.
 * A form for adding customer is shown
 * The field for name is filled in with "Test"
 * The field for surname is filled in with "Testsson"
 * All other fields are empty



##Test case 2.5: Failed adding customer with invalid telephone number
Make sure customer can't be added with a invalid telephone number

###Input:
 * Testcase 2.1
 * Fill in a name for the customer, i.e. "Test"
 * Fill in a surname for the customer, i.e. "Testsson"
 * Fill in a invalid telephone number i.e. "Invalid000"
 * Press "Add customer" button
 
###Output:
 * The text "The telephone number can only contain digits and has to be at least 8 digits long", is shown.
 * A form for adding customer is shown
 * The field for name is filled in with "Test"
 * The field for surname is filled in with "Testsson"
 * The field for telephone is filled in with "Invalid000"
 * All other fields are empty



##Test case 2.6: Failed adding customer without an email adress
Make sure customer can't be added without an email adress

###Input:
 * Testcase 2.1
 * Fill in a name for the customer, i.e. "Test"
 * Fill in a surname for the customer, i.e. "Testsson"
 * Fill in a valid telephone number i.e. "034089574"
 * Press "Add customer" button
 
###Output:
 * The text "The email adress has to follow following format email@domain.com", is shown.
 * A form for adding customer is shown
 * The field for name is filled in with "Test"
 * The field for surname is filled in with "Testsson"
 * The field for telephone is filled in with "034089574"
 * All other fields are empty



##Test case 2.7: Failed adding customer without invalid email adress
Make sure customer can't be added with a invalid email adress

###Input:
 * Testcase 2.1
 * Fill in a name for the customer, i.e. "Test"
 * Fill in a surname for the customer, i.e. "Testsson"
 * Fill in a valid telephone number i.e. "034089574"
 * Fill in the email adress with an invalid email adress i.e. "MyEmail.com"
 * Press "Add customer" button
 
###Output:
 * The text "The email adress has to follow following format email@domain.com", is shown.
 * A form for adding customer is shown
 * The field for name is filled in with "Test"
 * The field for surname is filled in with "Testsson"
 * The field for telephone is filled in with "034089574"
 * The field for email is filled in with "MyEmail.com"



##Test case 2.8: Success adding a new customer to database
Make sure customer can be added with all fields filled in with valid information

###Input:
 * Testcase 2.1
 * Fill in a name for the customer, i.e. "Test"
 * Fill in a surname for the customer, i.e. "Testsson"
 * Fill in a valid telephone number i.e. "034089574"
 * Fill in the email adress with a valid email adress i.e. "test.testsson@domain.com"
 * Press "Add customer" button
 
###Output:
 * The text "Customer was successfully added to catalogue", is shown.
 * A table for the customer register is shown.
 * The customer just added is part of the table



##Test case 2.8: Failed adding a new customer to database with the same name as another customer
Make sure customer can't be added if the fullname of the customer is equal to another one in the database

###Input:
 * Testcase 2.8

 
###Output:
 * The text "A customer with the name Test Testsson already exists", is shown.
 * A form for adding customer is shown.
 * All fields are filled in.


***

##Test case 3.1: Failed updating a customer to have the same name as another one
Make sure it is not possible to update a customer to have the same name as an another one

###Prepare test:
###Input:
 * Testcase 2.8
 * Change the surname to "Testsson2"
 * Press "Add customer" button
 
###Output:
 * The text "Customer was successfully added to catalogue", is shown.
 * A table for the customer register is shown.
 * The customer just added is part of the table

###Actual test:
###Input:
 * Click the edit link for customer Test Testsson2
 * Change surname to "Testsson"
 * Press "Update customer" button
 
###Output:
 * The text "A customer with the name Test Testsson already exists", is shown.
 * A form for updating customer is shown
 * The input fields are filled in with the information from the customer



##Test case 3.2: Failed updating a customer to have invalid information
Make sure it is not possible to update a customer to have invalid information

###Input:
* Same as Testcases 2.2 - 2.7
 
###Output:
* Same as Testcases 2.2 - 2.7
* A form for updating customer is shown
* The input fields are filled in with the information from the customer



##Test case 3.3: Success updating customer with valid information
Make sure it is possible to update a customer with enw valid information

###Input:
* Testcase 3.1
* Set surname to "Testsson4"
* Set email to "testsson4@domain.com"
 
###Output:
* The text "Customer Test Testsson4 was successfully updated", is shown
* A form for updating customer is shown
* The input fields are filled in with the new information for the customer




***

##Test case 4.1: Try deleting customer
Make sure a customer can't be deleted without an extra check

###Input:
 * Testcase 1.1
 * Click the link "Customers"
 * Choose to delete customer Test Testsson4
 
###Output:
* The text "Are you sure you want to delete customer: Test Testsson4", is shown.
* A small form is shown with two options: "No, go back to customer lisitng", and "Yes, delete customer"



##Test case 4.1: Success deleting customer
Make sure a customer can be deleted

###Input:
* Testcase 4.1
* Press "Yes, delete customer" button
 
###Output:
* The text "Customer Test Testsson4 was successfully deleted", is shown.
* A table for the customer register is shown.


