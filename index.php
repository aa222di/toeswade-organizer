<?php
//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//INCLUDE THE FILES NEEDED...
require_once('autoloader.php');
session_start();


// Start db
// CONNECT TO DATABASE
	$user = 'toeswade';
	$pwd = 'password123';

// SMALL CHECK TO HAVE THE SAME CODE ON SERVER AND LOCALHOST
if ($_SERVER['HTTP_HOST'] == 'localhost') {
	$user = 'root';
	$pwd = 'root';
}
echo ($user . '...' . $pwd);
$db = new \Toeswade\Database\Database('localhost', 'toeswade', $user, $pwd);


$nav = new \Toeswade\Navigation\CNavigation();

// Start page
$start = new \Toeswade\Navigation\NavItem('Start', '');
$nav->addNavigationItem($start); 

// Customer page
$controller = new \Toeswade\Customer\CCustomer($db);
$test = new \Toeswade\Navigation\NavItem('Customers', 'customers', $controller);
$nav->addNavigationItem($test); 

// Add new Customer page
$controller = new \Toeswade\Customer\CCustomer($db);
$test = new \Toeswade\Navigation\NavItem('Add customer', 'customers', $controller, 'create');
$nav->addNavigationItem($test); 

// Start theme
$path = 'app/basic/';
$themeEngine = new \Toeswade\Theme\CTheme($path, $db, $nav);


$themeEngine->indexAction();

