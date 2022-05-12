<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
    <h1>Add Food</h1>
    <br>
    <?php
    if(isset($_SESSION['upload'])){
        echo $_SESSION['upload'];
        echo '<br><br>';
        unset($_SESSION['upload']);// Removing session 
    }       
    if(isset($_SESSION['add-food'])){
        echo $_SESSION['add-food'];
        echo '<br><br>';
        unset($_SESSION['add-food']);// Removing session 
    }       
    ?>
    <!-- category form -->
    <form action="" method="post" enctype="multipart/form-data">
        <table class="tbl">
            <tr>
                <td>Title: </td>
                <td><input type="text" name="title" placeholder="Food Title"></td>
            </tr>
            <tr>
                <td>Description: </td>
                <td><textarea name="description" id="" cols="35" rows="7" placeholder="Description of Food"></textarea></td>
            </tr>
            <tr>
                <td>Price:</td>
                <td> <input type="number" name="price">
                </td>
            </tr>
            <tr>
                <td>Select Image:</td>
                <td> <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Select Category:</td>
                <td> <select  name="category">
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
                                $id=$row['id'];
                                ?>
                                <option value="<?php echo $id ;?>"><?php echo $category ;?></option>
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
                <td>Featured:  </td>
                <td><input type="radio" name="featured" value="Yes" id="">Yes
                <input type="radio" name="featured" value="No" id="">No</td>
            </tr>
            <tr>
                <td>Active: </td>
                <td><input type="radio" name="active" value="Yes" id="">Yes
                <input type="radio" name="active" value="No" id="">No</td>
            </tr>
            <tr >
                <td colspan="2"><input type="submit" name="submit" value="Add Food" class="btn-secondary"></td>
            </tr>
        </table>
    </form>

    <!-- category form ends -->
    <?php
    if(isset($_POST['submit'])){
        
        // add the food to database
        $title=$_POST['title'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $category=$_POST['category'];

        // for radio btn check if checked or not
        if(isset($_POST['featured'])){
            // get the value
            $featured=$_POST['featured'];
        }else{
            // set the default value
            $featured="No";
        }

        if(isset($_POST['active'])){
            // get the value
            $active=$_POST['active'];
        }else{
            // set the default value
            $active="No";

        }

        // Check wether image selected or not
        if(isset($_FILES['image']['name'])){
            // dont upload imgage
            $image_name=$_FILES['image']['name'];
            
         //Check if image name is availble or not then only upload the image 
          if($image_name!=""){

            // auto rename our image
            // get extension of image(jpg,png,gif)
            $ext=end(explode('.',$image_name));
            // if ext is jfif make it png
            
            //  renam the image now
            $image_name="Food_".rand(000,999).'.'.$ext; //eg=Food_878.jpg

            $source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/food/".$image_name;
            // echo $destination_path;
                
            // Finaly upload image
            $upload=move_uploaded_file($source_path,$destination_path);

            // Check wether image is uploaded
            // If image not uplodade we stop and redirect 
            if($upload==false){
                // set message
                $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                header("location: ".SITEURL.'admin/add-food.php');//redirect to add category
                // stop process
                die();
            }
        }
        }else{
            // dont upload
            $image_name="";//default name=blank

        }

        // sql query to inseert data
        $sql2="INSERT INTO `tbl_food` (`tittle`,`discription`,`price`,`image_name`,`category_id`,`featured`, `active`) VALUES ( '$title', '$description',$price,'$image_name', $category,'$featured', '$active');";
        $res2=mysqli_query($con,$sql2);
        if($res2){
            // data inserted
            $_SESSION['add-food']="<div class='success'>Food added successfully</div>";
            header("location: ".SITEURL.'admin/manage-food.php'); 
        }else{
            // Failed to insert
            $_SESSION['add-food']="<div class='error'>Failed to add food</div>";
            header("location: ".SITEURL.'admin/add-food.php'); 
        }

    }
    ?>
    </div>
</div>
<?php include('partials/footer.php');?>