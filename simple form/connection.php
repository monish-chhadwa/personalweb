<?php
//connect.php
$server = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'form';

//Connection using PDO
try{
    $connection=new PDO('mysql:host='.$server.';dbname='.$database, $username,  $password);
    //print('Succesfully connected to database!<br/>');
} catch(PDOException $e){
    print "Error!: ".$e->getMessage()."<br/>";
    die();
}
?>
