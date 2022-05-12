
<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <form  class="tbl-30" action="" method="POST">
            <div class="form-input">Full Name:<input type="text" name="fullname" id="fullname" placeholder="Enter Your Name"></div>     
            <div class="form-input">User Name:<input type="text" name="username" id="username" placeholder="Enter Your Username"></div>     
            <div class="form-input">Password:<input type="password" name="password" id="password" placeholder="Enter Your Password"></div>
            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">    

        </form>
    </div>
</div>

<?php include('partials/footer.php');?>
<?php
// Process the value from form 
if(isset($_POST['submit'])){
    // echo"Button clicked";
    // Get data from form
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $password=md5($_POST['password']); //Password encryption with md5
    // Sql query to crate database
    $sql="INSERT INTO `food-order`.`tbl_admin` ( `fullname`, `username`,`password`) VALUES ( '$fullname', '$username', '$password')";
    // echo $sql;


    $res=mysqli_query($con,$sql) or die(mysqli_error());

    // Check if data inserted or not;
    if($res==true){
        // echo "Data Inserted";
        // data inserted
        $_SESSION['add']="<div class='success'>Admin added successfully</div>";
        header("location: ".SITEURL.'admin/manage-admin.php'); 
        // redirect page
        
        }else{
            $_SESSION['add']="<div class='error'>Failed to add admin</div>";
            header("location: ".SITEURL.'admin/add-admin.php'); 
        // echo"Fail to insert data";
    }

}

// Check if button is Cliced

?>

