<?php 
session_start();
//connect.php
$server	    = 'mysql5.000webhost.com';
$username	= 'a6004573_root';
$password	= 'toor@123';
$database	= 'a6004573_fourm';

if(!mysql_connect($server, $username, $password))
{
 	exit('Error: could not establish database connection');
}
if(!mysql_select_db($database))
{
 	exit('Error: could not select the database');
}
?>

