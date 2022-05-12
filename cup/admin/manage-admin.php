<?php include('partials/menu.php');?>


<!-- Main section -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br />
        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            echo '<br><br>';
            unset($_SESSION['add']);// Removing session  
        }
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            echo '<br><br>';
            unset($_SESSION['delete']);// Removing session  
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            echo '<br><br>';
            unset($_SESSION['update']);// Removing session  
        }
        if(isset($_SESSION['user-not-found'])){
            echo $_SESSION['user-not-found'];
            echo '<br><br>';
            unset($_SESSION['user-not-found']);// Removing session  
        }
        if(isset($_SESSION['pass-not-match'])){
            echo $_SESSION['pass-not-match'];
            echo '<br><br>';
            unset($_SESSION['pass-not-match']);// Removing session  
        }
        if(isset($_SESSION['change-pwd'])){
            echo $_SESSION['change-pwd'];
            echo '<br><br>';
            unset($_SESSION['change-pwd']);// Removing session  
        }
        ?>

        <!-- Button to add admin -->
        <a href="add-admin.php" class="btn-primary">+Add Admin</a>
        <br />
        <br />

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>FullName</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php
            // Query to get all admin
            $sql="SELECT * FROM `tbl_admin`";
            $res=mysqli_query($con,$sql);

            // Check wehter query executed
            if($res){
                // Count rows to check if admin exists
                $count=mysqli_num_rows($res); //Function to get all the rows of admin

                if($count>0){
                    // we have data in database
                    // using while loop to display data
                    $sn=1;
                    while($row=mysqli_fetch_assoc($res)){
                        // Get indivdual data;
                        $id=$row['id'];
                        $name=$row['fullname'];
                        $username=$row['username'];
                 echo '       <tr>
                <td>'.$sn++.'</td>
                <td>'.$name.'</td>
                <td>'.$username.'</td>
                <td>
                <a href="'.SITEURL.'admin/update-admin.php?id='.$id.'" class="btn-secondary">Update Admin</a>
                <a href="'.SITEURL.'admin/update-password.php?id='.$id.'" class="btn-primary">Change Password</a>
                <a href="'.SITEURL.'admin/deleteadmin.php?id='.$id.'" class="btn-danger">Delete Admin</a>
                    
                </td>
            </tr>';
                    }

                }else{

                }
            }
            ?>





        </table>


    </div>
</div>

<!-- Main section ends-->


<?php include('partials/footer.php');?>