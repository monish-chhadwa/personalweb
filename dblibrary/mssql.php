<?php
/**
 * Created by PhpStorm.
 * User: monish.c
 * Date: 8/6/2015
 * Time: 3:30 PM
 */
include_once('model.php');
$dbsys = 'mssql';
$server = 'MDVWMONISHC';
$username   = 'DIRECTI\monish.c';
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

//echo php_ini_loaded_file();