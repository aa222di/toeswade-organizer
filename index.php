<?php
//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//INCLUDE THE FILES NEEDED...
require_once('autoloader.php');
session_start();

$config = include('app/basic/config/config.php');

$test = new \Toeswade\Theme\CTheme($config);
	//var_dump($_SERVER);

$test->indexAction();

