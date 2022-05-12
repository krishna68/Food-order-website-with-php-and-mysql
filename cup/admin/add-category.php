<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
    <h1>Add Category</h1>
    <br>
    <?php
        if(isset($_SESSION['add-caetgory'])){
            echo $_SESSION['add-category'];
            echo '<br><br>';
            unset($_SESSION['add-category']);// Removing session  
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            echo '<br><br>';
            unset($_SESSION['upload']);// Removing session  
        }
    ?>
    <!-- category form -->
    <form action="" method="post" enctype="multipart/form-data">
        <table class="tbl">
            <tr>
                <td>Title: </td>
                <td><input type="text" name="title" palceholder="Category Title"></td>
            </tr>
            <tr>
                <td>Select Image</td>
                <td> <input type="file" name="image">
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
                <td colspan="2"><input type="submit" name="submit" value="Add Category" class="btn-secondary"></td>
            </tr>
        </table>
    </form>

    <!-- category form ends -->
    <?php
    if(isset($_POST['submit'])){
        $title=$_POST['title'];
        // for radio btn
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
        // print_r($_FILES['image']);
        // die();
        if(isset($_FILES['image']['name'])){
            // dont upload imgage
            $image_name=$_FILES['image']['name'];
            
         //Check if image name is availble or not then only upload the image 
          if($image_name!=""){
            // auto rename our image
            // get extension of image(jpg,png,gif)
            $ext=end(explode('.',$image_name));
            //  renam the image now
            $image_name="Food_category_".rand(000,999).'.'.$ext; //eg=Food_Category_878.jpg
            $source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/category/".$image_name;
            echo $destination_path;    
            // Finaly upload image
            $upload=move_uploaded_file($source_path,$destination_path);
            // Check wether image is uploaded
            // If image not uplodade we stop and redirect 
            if($upload==false){
                // set message
                $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                header("location: ".SITEURL.'admin/add-category.php');//redirect to add category
                // stop process
                die();
            }
        }
        }else{
            // dont upload
            $image_name='';//blank

        }

        // sql query to inseert data
        $sql="INSERT INTO `tbl_category` (`tittle`, `image_name`,`featured`, `active`) VALUES ( '$title', '$image_name', '$featured', '$active');";
        $res=mysqli_query($con,$sql);
        if($res){
            // data inserted
            $_SESSION['add-category']="<div class='success'>Category added successfully</div>";
            header("location: ".SITEURL.'admin/manage-category.php'); 
        }else{
            // Failed to insert
            $_SESSION['add-category']="<div class='error'>Failed to add category</div>";
            header("location: ".SITEURL.'admin/add-category.php'); 
        }

    }
    ?>
    </div>
</div>
<?php include('partials/footer.php');?>