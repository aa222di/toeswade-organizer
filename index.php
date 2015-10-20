<?php
//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//INCLUDE THE FILES NEEDED...
require_once('autoloader.php');
session_start();

$test = new \Toeswade\Theme\CTheme('Test');
