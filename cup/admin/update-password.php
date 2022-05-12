<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <!-- Update admin form -->

        <?php
        // 1.Get the id of the admin to be updated
        $id=$_GET['id'];
        
        
        
        ?>
        <form  class="tbl-30" action="" method="POST">
            <div class="form-input">Current Password:<input type="password" name="current_pass" placeholder="Current Password"></div>     
            <input type="hidden" name="admin-id" value="<?php echo $id;?>" >   
            <div class="form-input">New Password:<input type="password" name="new_pass" placeholder="New Password"></div>     
            <div class="form-input">Confirm Password:<input type="password" name="cnew_pass" placeholder="Confirm New Password"></div>     
            
            <input type="submit" name="submit" value="Change Password" class="btn-secondary">    

        </form>
    </div>
</div>

<?php
//Update the password from form 
if(isset($_POST['submit'])){
    // echo"Button clicked";
    // Get data from form
    $id=$_POST['admin-id'];
    $current=md5($_POST['current_pass']);
    $newpassword=md5($_POST['new_pass']);
    $cnewpassword=md5($_POST['cnew_pass']);
    
    // check if password match and user is present
    $sql="SELECT * FROM tbl_admin WHERE id=$id and password='$current'";
    
    
    // Execute the query
    $res=mysqli_query($con,$sql);
    
    //  Check if data inserted or not;
    if($res==true){
        // check wether data available
        $count=mysqli_num_rows($res);
        if($count==1){
            // user exists
            
            // Check wether new pass and confirm match or not
            if($newpassword==$cnewpassword){
                // Update the password
                $sql2="UPDATE `tbl_admin` SET `password` = '$newpassword' WHERE `tbl_admin`.`id` = $id";
                $res2=mysqli_query($con,$sql2);
                if($res2){
                    // Password changed
                    $_SESSION['change-pwd']=" <div class='success'>Passwords changed successfully.</div> ";
                    header("location: ".SITEURL.'admin/manage-admin.php'); 
                }else{
                    // Password did not changed
                    $_SESSION['change-pwd']=" <div class='error'>Failed to change password</div> ";
                    header("location: ".SITEURL.'admin/manage-admin.php'); 
                }
            }else{
                // redirect to manage-admin
                $_SESSION['pass-not-match']=" <div class='error'>Passwords do not match.</div> ";
                header("location: ".SITEURL.'admin/manage-admin.php'); 
            }
        }else{
            $_SESSION['user-not-found']=" <div class='error'>User not found.</div> ";
            header("location: ".SITEURL.'admin/manage-admin.php'); 
        }
       
        
    }
    
}

// Check if button is Cliced

?>

<?php include('partials/footer.php');?>