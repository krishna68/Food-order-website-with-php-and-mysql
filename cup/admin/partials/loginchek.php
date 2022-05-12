<?php
// checking authorization
if(!isset($_SESSION['user'])){
// user is not logedin
$_SESSION['no-login']=" <div class='error text-center'>Please login to access admin panel</div> ";
// redirect tologin.php
header("location: ".SITEURL.'admin/login.php');
}