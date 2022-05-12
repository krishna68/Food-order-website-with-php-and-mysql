<?php
// detsrtoy the session
include('config/constants.php');
session_destroy();
// Redrect to lgoin page
header("location: ".SITEURL.'admin/login.php');
?>