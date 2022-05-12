<?php
// Session starts
session_start();

// Define variabeles
define('SITEURL','http://localhost/cup/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');

define('DB_DATABASE','food-order');
// Creating database connecton and selecting the database
$con=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
$db_select=mysqli_select_db($con,DB_DATABASE) or die(mysqli_error());
?>