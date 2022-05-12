<?php
include ('config/constants.php');
// Get id of the admin to be deleted;
$id=$_GET['id'];
// Delete the admin by sql;
$sql="DELETE FROM `tbl_admin` WHERE `tbl_admin`.`id` = $id";

$res=mysqli_query($con,$sql);

if($res){
    // Admin deleted
    // echo 'Admin deleted';
    // Create session variable to show delete msg
    $_SESSION['delete']="<div class='success'>Admin Delted Successfully</div>";
    // Redirect to  manage admin page
    header("location: ".SITEURL.'admin/manage-admin.php'); 

}else{
    // echo "failed to delte admin";
    $_SESSION['delete']="<div class='error'> Failed to delete. Try Again later.</div>";
    // Redirect to  manage admin page
    header("location: ".SITEURL.'admin/manage-admin.php'); 
}


?>