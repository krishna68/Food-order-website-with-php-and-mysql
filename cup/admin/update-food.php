<?php include('partials/menu.php'); ?>
<?php
if(isset($_GET['id'])){
    // get id
    $id=$_GET['id'];
    // get all the details of this id from database
    $sql2="SELECT * FROM tbl_food WHERE id=$id"; 
    $res2=mysqli_query($con,$sql2);
    $count2=mysqli_num_rows($res2);
    if($count2==1){
        // get details
        $row2=mysqli_fetch_assoc($res2);
        $title=$row2['tittle'];
        $desc=$row2['discription'];
        $price=$row2['price'];
        $current_image=$row2['image_name'];
        $current_category=$row2['category_id'];
        $featured=$row2['featured'];
        $active=$row2['active'];
    }else{
        // redirect back
        $_SESSION['no-food']="<div class='error'>No category found</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
}else{
    // redirect to food-maange
    // $_SESSION['delete']=" <div class='error'>Unauthorized Access</div>  ";
    header('location:'.SITEURL.'admin/manage-food.php');
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br>
        <?php
           
    ?>
        <!-- category form -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title;?>"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" id="" cols="35" rows="7"><?php echo $desc;?></textarea></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td> <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                    if($current_image!=""){
                        // display image
                    ?>
                        <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image; ?>"
                            alt="<?php echo $title; ?>" width="100px" />
                        <?php   
                    }else{
                        echo"<div class='error'>No Image Added</div>";
                    }
                  ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td> <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Select Category:</td>
                    <td> <select name="category">
                            <?php
                    // getting category from database
                    $sql="SELECT * FROM `tbl_category` WHERE active='Yes'";

                    $res=mysqli_query($con,$sql);
                    if($res){
                        $count=mysqli_num_rows($res); 
                        if($count>0){
                            // we have categories
                            while($row=mysqli_fetch_assoc($res)){
                                // get categories details 
                                $category=$row['tittle'];
                                $category_id=$row['id'];
                                ?>
                            <option <?php if($current_category==$category_id){echo"selected";}?>
                                value="<?php echo $id ;?>"><?php echo $category ;?></option>
                            <?php
                            }
                        }else{
                            // no category
                         echo '<option value="0">No Category found</option>';
                        }
                    }
                    ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td><input type="radio" <?php if($featured=="Yes"){echo "checked";} ?> name="featured" value="Yes"
                            id="">Yes
                        <input type="radio" <?php if($featured=="No"){echo "checked";} ?> name="featured" value="No"
                            id="">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td><input type="radio" <?php if($active=="Yes"){echo "checked";}?> name="active" value="Yes"
                            id="">Yes
                        <input type="radio" <?php if($active=="No"){echo "checked";}?> name="active" value="No" id="">No
                    </td>
                </tr>
                <tr>
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <td colspan="2"><input type="submit" name="submit" value="Update Food" class="btn-secondary"></td>
                </tr>
            </table>
        </form>

        <!-- category form ends -->
        <?php
    if(isset($_POST['submit'])){      
    //  get all the details from the form
    $id=$_POST['id'];
    $current_im=$_POST['current_image'];
    $title=$_POST['title'];
    $desc=$_POST['description'];
    $price=$_POST['price'];
    $category=$_POST['category'];
    $featured=$_POST['featured'];
    $active=$_POST['active'];
    // 2.uplod the image if selected
        if(isset($_FILES['image']['name'])){
            // echo "selected";
            $image_name=$_FILES['image']['name']; //new image name
        // check wether image available or not
        if($image_name!=""){
            // image available
            // rename the image
        // get extension of image(jpg,png,gif)
        $ext=end(explode('.',$image_name));
        
        //  renam the image now
        $image_name="Food_".rand(000,999).'.'.$ext;
        
        $source_path=$_FILES['image']['tmp_name'];
        $destination_path="../images/food/".$image_name;
        // Finaly upload new image
        $upload=move_uploaded_file($source_path,$destination_path);
            // check wether image is uplaoded or noy
            if($upload==false){
                // stop the process and redirect
                $_SESSION['upload'] ='<div class="error">Failed to upload the new image</div>';
                header('location:'.SITEURL.'admin/manage-food.php'); 
                die();
            }
         //remove current image if available
         if($current_im!=""){
            $remove_path="../images/food/".$current_image;
            $remove=unlink($remove_path);
            // check wether image remove or not
            if($remove==false){
            //  fialed to remive image
            $_SESSION['remove-failed'] ='<div class="error">Failed to remove current image</div>';
            header('location:'.SITEURL.'admin/manage-food.php');
            die();
            }
         } 
    }else{
        $image_name=$current_im;//default image when image not selected
    }
}else{
        $image_name=$current_im;//image when button not cliked
        }   
        // upload new data in database
        $sql3="UPDATE `tbl_food` SET `tittle` = '$title',`discription`='$desc',`price`='$price',`image_name`='$image_name',`category_id`='$category',`featured` = '$featured',`active` = '$active' WHERE `tbl_food`.`id` = $id"; 
        $res3=mysqli_query($con,$sql3);
        if($res3==true){
            // query executed
            $_SESSION['update'] ='<div class="success">Food updated successfully</div>';
            header('location:'.SITEURL.'admin/manage-food.php');
        }else{
            // failed to upload
            $_SESSION['update'] ='<div class="error">Failed to update food. Try again later.</div>';
            header('location:'.SITEURL.'admin/manage-food.php');
        }
}
    ?>
    </div>
</div>
<?php include('partials/footer.php');?>