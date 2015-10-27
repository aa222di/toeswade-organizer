<?php
session_start();
//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//INCLUDE THE FILES NEEDED...
require_once('autoloader.php');

// CONNECT TO DATABASE
	$user = 'toeswade';
	$pwd = 'password123';
// Small check to adapt pwd and user to server
if ($_SERVER['HTTP_HOST'] == 'localhost') {
	$user = 'root';
	$pwd = 'root';
}
$db = new \Toeswade\Database\Database('localhost', 'toeswade', $user, $pwd);

// GET AND CONSTRUCT NAVIGATION 
$nav = new \Toeswade\Navigation\CNavigation();

// Start page
$start = new \Toeswade\Navigation\NavItem('Start', '');
$nav->addNavigationItem($start); 

// Customer page
$controller = new \Toeswade\Customer\CCustomer($db);
$listCustomers = new \Toeswade\Navigation\NavItem('Customers', 'customers', $controller);
$nav->addNavigationItem($listCustomers); 

// Add new Customer page
$addCustomer = new \Toeswade\Navigation\NavItem('Add customer', 'customers', $controller, 'create');
$nav->addNavigationItem($addCustomer);

// Reset customer database
$addCustomer = new \Toeswade\Navigation\NavItem('Reset database', 'customers', $controller, 'reset');
$nav->addNavigationItem($addCustomer); 



// CREATE THE THEME OBJECT
$path = 'app/basic/';
$themeEngine = new \Toeswade\Theme\CTheme($path, $db, $nav);


// INDEX PAGES AND RENDER APP
$themeEngine->index();