<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <!-- Update admin form -->

        <?php
        // 1.Get the id of the admin to be updated
        $id=$_GET['id'];
        // Sql query 
        $sql="SELECT * FROM `tbl_admin` WHERE id=$id";
        $res=mysqli_query($con,$sql);

        if($res){
             // Count rows to check if admin exists
             $count=mysqli_num_rows($res); //Function to get all the rows of admin
             if($count==1){
                //  Get the details
                // echo "Admin Available";
                $row=mysqli_fetch_assoc($res);
                $name=$row['fullname'];
                $uname=$row['username'];
             }else{
                //  Redirect to manage admin page
                header("location: ".SITEURL.'admin/manage-admin.php');
             }
        }
        ?>
        <form  class="tbl-30" action="" method="POST">
            <div class="form-input">Full Name:<input type="text" name="fullname" id="fullname" value="<?php echo $name;?>" ></div>     
            <input type="hidden" name="admin-id" value="<?php echo $id;?>" >   
            <div class="form-input">User Name:<input type="text" name="username" id="username" value="<?php echo $uname;?>"></div>     
            
            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">    

        </form>
    </div>
</div>

<?php include('partials/footer.php');?>
<?php
//Update the value from form 
if(isset($_POST['submit'])){
    // echo"Button clicked";
    // Get data from form
    $id=$_POST['admin-id'];
     $fullname=$_POST['fullname'];
     $username=$_POST['username'];
    
    // Sql query to update admin
    $sql="UPDATE `tbl_admin` SET `fullname` = '$fullname',`username` = '$username' WHERE `tbl_admin`.`id` = $id";
    // // echo $sql;

    // Execute the query
    $res=mysqli_query($con,$sql);

    //  Check if data inserted or not;
    if($res==true){
        echo "Data Updated";
        // data inserted
        $_SESSION['update']="<div class='success'>Admin updated successfully</div>";
        // redirect page
        header("location: ".SITEURL.'admin/manage-admin.php'); 
        
        }else{
            $_SESSION['update']="<div class='error'>Failed to update admin</div>";
            header("location: ".SITEURL.'admin/manage-admin.php'); 
        // echo"Fail to insert data";
    }

}

// Check if button is Cliced

?>
