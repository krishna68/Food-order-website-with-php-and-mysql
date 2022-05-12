<?php
include ('config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginPage</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>
<body>
    <div class="log">
        <h1 class="text-center error">Login</h1>
        
        <?php
        if(isset($_SESSION['login'])){
            echo '<br>';
            echo $_SESSION['login'];
            unset ($_SESSION['login']);
        }
        if(isset($_SESSION['no-login'])){
            echo '<br>';
            echo $_SESSION['no-login'];
            unset ($_SESSION['no-login']);
        }
        ?>
        <!-- Login form starts -->
        <br>
        <form class="form text-center" action="" method="post">
            
            Username <input type="text" name="username" id="username" placeholder="Enter username">
            
            Password <input type="password" name="password"  placeholder="Enter Password">
            
            <input type="submit" name="submit" value="Login" class="btn-primary h" >
            <br>
        </form>
        <br>
        <!--  login form ends-->
        <p class="text-center"> Created by-
            <a href="">Krishna Taneja</a>

        </p>
    </div>
</body>
</html>
<?php
if(isset($_POST['submit'])){
    // button clicked
    echo $user_name=$_POST['username'];
    echo $pwd=md5($_POST['password']);
    // chech if user exists
    $sql="SELECT * FROM `tbl_admin` WHERE username='$user_name' AND password='$pwd'";
    $res=mysqli_query($con,$sql);
    if($res){
        $count=mysqli_num_rows($res);
        if($count==1){
            // user exists
            $_SESSION['login']=" <div class='success'>Loginend Succesfully</div>";
            $_SESSION['user']=$user_name; //to check if user loged in or nots
            header("location: ".SITEURL.'admin/');
        }else{
            // user not found
            $_SESSION['login']=" <div class='error text-center'>Username or password did not matched </div>";
            header("location: ".SITEURL.'admin/login.php');
        }
    }
}
?>