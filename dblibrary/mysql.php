<?php
/**
 * Created by PhpStorm.
 * User: monish.c
 * Date: 8/6/2015
 * Time: 3:30 PM
 */
include_once('model.php');
$dbsys = 'mysql';
$server = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'sample';

$conn = dbLibrary::getDbInstance($dbsys, $server, $username,  $password, $database);
//$conn = $connInitialize->createConnection();
//Now using this $conn connection object I can call various methods that are going to be available to the user!

//print_r($connInitialize);
print_r($conn);

$array=Array('table'=>'table 1',
    'cols'=> Array('*'));
$result=$conn->find($array,'count');
print_r($result);