<?php
/*
* iTech Empires:  Export Data from MySQL to CSV Script
* Version: 1.0.0
* Page: DB Connection
*/
///$db_host		= 'fdb30.awardspace.net';
//$db_user		= '3590879_inventory';
//$db_pass		= '3590879_inventory';
//$db_database	= '3590879_inventory';

// Connection variables
$host = "127.0.0.1"; // MySQL host name eg. localhost
$user = "root"; // MySQL user. eg. root ( if your on localserver)
$password = ""; // MySQL user password  (if password is not set for your root user then keep it empty )
$database = "3590879_inventory"; // MySQL Database name

// Connect to MySQL Database
$con = new mysqli($host, $user, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>