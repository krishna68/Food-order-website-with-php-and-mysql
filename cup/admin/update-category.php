<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
    <h1>Update Category</h1>
    <br>
    <?php
        // check wether id is set or not 
        if(isset($_GET['id'])){
            
            // get id
            $id=$_GET['id'];
            $sql="SELECT * FROM tbl_category WHERE id=$id"; 
            $res=mysqli_query($con,$sql);
            $count=mysqli_num_rows($res);
            if($count==1){
                // get all the data
                $row=mysqli_fetch_assoc($res);
                $title=$row['tittle'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];

            }else{
                // redirect to mange category page with error 
                $_SESSION['no-category']="<div class='error'>No category found</div>";
                header('location:'.SITEURL.'admin/manage-category.php');  
            }
        }else{
            // redirect
            header('location:'.SITEURL.'admin/manage-category.php'); 
        }
    ?>
    <!-- category form -->
    <form action="" method="post" enctype="multipart/form-data">
        <table class="tbl">
            <tr>
                <td>Title: </td>
                <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
            </tr>
            <tr>
                <td>Current Image</td>
                <td> <?php
                if($current_image!=""){
                    // display image
                  ?>
                  <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width ="100px" alt="">
                  <?php  
                }else{
                    // display message
                    echo '<div class="error">Image not added</div>';
                }
                ?>
                </td>
            </tr>
            <tr>
                <td>New Image</td>
                <td> <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Featured:  </td>
                <td><input type="radio" <?php if($featured=="Yes"){echo "checked";} ?> name="featured" value="Yes" id="">Yes
                <input type="radio" <?php if($featured=="No"){echo "checked";} ?> name="featured" value="No" id="">No</td>
            </tr>
            <tr>
                <td>Active: </td>
                <td><input type="radio"<?php if($active=="Yes"){echo "checked";} ?> name="active" value="Yes" id="">Yes
                <input type="radio" <?php if($active=="No"){echo "checked";}?> name="active" value="No" id="">No</td>
            </tr>
            <tr >
            <td colspan="2">
                <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="submit" value="Update Category" class="btn-secondary"></td>
            </tr>
        </table>
    </form>

    <!-- category form ends -->
    <?php
    if(isset($_POST['submit'])){
        // get all the value
        $title=$_POST['title'];
        $id=$_POST['id'];
        $current_images=$_POST['current_image'];
        $featured=$_POST['featured'];
        $active=$_POST['active'];
        // updating the new image if selected and check wehter image selected or not
        if(isset($_FILES['image']['name'])){
            // echo "selected";
            $image_name=$_FILES['image']['name'];
            // check wether image available or not
        if($image_name!=""){
                // image available
                // upload new image and remove current one
                // auto rename new image
            // get extension of image(jpg,png,gif)
            $ext=end(explode('.',$image_name));
            //  renam the image now
            $image_name="Food_category_".rand(000,999).'.'.$ext;
            
            $source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/category/".$image_name;
            // Finaly upload new image
            $upload=move_uploaded_file($source_path,$destination_path);
            // Check wether image is uploaded
            // If image not uplodade we stop and redirect 
            if($upload==false){
                // set message
                $_SESSION['upload']="<div class='error'>Failed to upload new image</div>";
                header("location: ".SITEURL.'admin/manage-category.php');//redirect to add category
                // stop process
                die();
            }
            // remove the current image if available
            if($current_image!=""){

                $remove_path="../images/category/".$current_image;
                $remove=unlink($remove_path);
                // check wether image is removed or not
                if($remove==false){
                    // failed to remove
                    $_SESSION['failed-remove'] ='<div class="error">Failed to remove current image</div>';
               header('location:'.SITEURL.'admin/manage-category.php'); 
               die();
                }
            }
        }else{
                $image_name=$current_image;                
        }

        }else{
            $image_name=$current_image;
        }
        
        // update the category database
        $sql2="UPDATE `tbl_category` SET `tittle` = '$title',`image_name`='$image_name',`featured` = '$featured',`active` = '$active' WHERE `tbl_category`.`id` = $id";
        $res2=mysqli_query($con,$sql2);
        // check if executed or not
        
        if($res2){
            // category updated
           $_SESSION['update-category'] ='<div class="success">Catgeory Updated Successfuly</div>';
           header('location:'.SITEURL.'admin/manage-category.php'); 
        }else{
            // failed to update
            $_SESSION['update-category'] ='<div class="error">Failed to update. Try again later</div>';
           header('location:'.SITEURL.'admin/manage-category.php'); 
        }
 
        // redirect to manage
        // Check wether image selected or not
        // print_r($_FILES['image']);
        // die();
        
        

    }
    ?>
    </div>
</div>
<?php include('partials/footer.php');?>