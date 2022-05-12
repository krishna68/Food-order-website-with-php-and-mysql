<?php
include ('config/constants.php');
if(isset($_GET['id']) AND isset($_GET['image_name'])){
// delete category
$id=$_GET['id'];
$image=$_GET['image_name'];
// remove physical  image file if available

if($image!=''){
    // image available,so remove it
    $path="../images/category/".$image;
    // remove image

    $remove=unlink($path);
    // if failed to delete image stop process
    if($remove==false){
        $_SESSION['remove']="<div class='error'>Failed to remove category image</div>";
        header('location:'.SITEURl.'admin/manage-category.php');
        // stop the process
        die();
    }
}
// Delete from data base
$sql="DELETE FROM `tbl_category` WHERE `tbl_category`.`id` = $id";
    $res=mysqli_query($con,$sql);
if($res){
    // data deleted
    $_SESSION['delete']="<div class='success'>Category Delted Successfully</div>";
    // Redirect to  manage category page
    header("location: ".SITEURL.'admin/manage-category.php');
}else{
    // failed to delete
    $_SESSION['delete']="<div class='error'> Failed to delete. Try Again later.</div>";
    // Redirect to  manage admin page
    header("location: ".SITEURL.'admin/manage-category.php'); 
}


// Redirect to manage caategory page

// echo "hy";
}else{
    
     header('location:'.SITEURL.'admin/manage-category.php');
}
?>