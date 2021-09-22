<?php
session_start();
/*
 * This goes up one level out of /public
 * and goes into /App to find bootstrap.php
 */
require(dirname(__FILE__).'/../App/bootstrap.php');

/*
* Handle all queries
*/
$request = [
    'get'   => $_GET,
    'post'  => $_POST,
    'files' => $_FILES
];
new BIT703\Classes\Router($request);