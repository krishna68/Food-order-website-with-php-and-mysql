<?php
echo"hi";
include ('config/constants.php');
// Get id of the food to be deleted;
if(isset($_GET['id']) AND isset($_GET['image_name'])){
// process to delete
// 1.get id and image name
$id=$_GET['id'];
$image=$_GET['image_name'];
//2.delete imaeg if avialable
// check wether image is available or not then only delete it
if($image!=""){
    // delte image from folder
    $path="../images/food/".$image;
    // remove image
    $remove=unlink($path);
     // if failed to delete image stop process
    if($remove==false){
        $_SESSION['remove']="<div class='error'>Failed to remove image file</div>";
        header('location:'.SITEURl.'admin/manage-food.php');
        // stop the process
        die();
    }
}
// delete food from database
$sql="DELETE FROM `tbl_food` WHERE `tbl_food`.`id` = $id";
$res=mysqli_query($con,$sql);
if($res){
    // food deleted
    $_SESSION['delete']=" <div class='success'>Food Delted Successfully</div>  ";
    header('location:'.SITEURL.'admin/manage-food.php');
}else{
    // redirect
    $_SESSION['delete']=" <div class='error'>Failed to delete Food.Try again later</div>  ";
    header('location:'.SITEURL.'admin/manage-food.php');
}
}else{
    // redirect to food page
    $_SESSION['delete']=" <div class='error'>Unauthorized Access</div>  ";
    header('location:'.SITEURL.'admin/manage-food.php');
}
?>