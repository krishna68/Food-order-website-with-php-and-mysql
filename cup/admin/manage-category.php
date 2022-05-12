<?php include('partials/menu.php');?>


<!-- Main section -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br />
        <?php
        if(isset($_SESSION['add-category'])){
            echo $_SESSION['add-category'];
            echo '<br><br>';
            unset($_SESSION['add-category']);// Removing session  
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            echo '<br><br>';
            unset($_SESSION['upload']);// Removing session  
        }
        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];
            echo '<br><br>';
            unset($_SESSION['remove']);// Removing session  
        }
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            echo '<br><br>';
            unset($_SESSION['delete']);// Removing session  
        }
        if(isset($_SESSION['no-category'])){
            echo $_SESSION['no-category'];
            echo '<br><br>';
            unset($_SESSION['no-category']);// Removing session  
        }
        if(isset($_SESSION['update-category'])){
            echo $_SESSION['update-category'];
            echo '<br><br>';
            unset($_SESSION['update-category']);// Removing session  
        }
    ?>
        <!-- Button to add admin -->
        <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">+Add Category</a>
        <br />
        <br />

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <!-- php to ge all the categories -->

            <?php
            // Query to get all admin
            $sql="SELECT * FROM `tbl_category`";
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
                        $title=$row['tittle'];
                        $image=$row['image_name'];
                        $featured=$row['featured'];
                        $active=$row['active'];
                 echo '<tr>
                 <td>'.$sn++.'</td>
                 <td>'.$title.'</td>
                 <td>';
                 if($image!=""){
                    //  display image
                ?>
                <img src="<?php echo SITEURL;?>images/category/<?php echo $image;?>" width ="100px" alt="">

                <?php
                 }else{
                    // show error
                    echo '<div class="error">Image not added</div>';
                 }
    
                 echo'</td>
                 <td>'.$featured.'</td>
                 <td>'.$active.'</td>
                 <td >
                     <a href="'.SITEURL.'admin/update-category.php?id='.$id.'" class="btn-secondary">Update Category</a>
                     <a href="'.SITEURL.'admin/delete-category.php?id='.$id.'&image_name='.$image.'" class="btn-danger">Delete Category</a>
 
                 </td>
             </tr>';
                    }

                }else{
                    // no data of category
                echo '<tr>
                <td colspan="6"><div class="error">No Category added</div></td>
                </tr>';
                
                }
            }
            ?>
            <!-- <tr>
                <td>1.</td>
                <td>Krishna Taneja</td>
                <td>ktkrish</td>
                <td>
                    <a href="" class="btn-secondary">Update Admin</a>
                    <a href="" class="btn-danger">Delete Admin</a>

                </td>
            </tr> -->
            


        </table>


    </div>
</div>

<!-- Main section ends-->


<?php include('partials/footer.php');?>