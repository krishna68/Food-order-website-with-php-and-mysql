<?php include('partials-frontend/_navbar.php');?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
        // create sql query to get data from database 
        $sql="SELECT * FROM `tbl_category` WHERE active='Yes'";
        $res=mysqli_query($con,$sql);
        // count rows to check if catgeories avaialable or not
        $count=mysqli_num_rows($res);
        if($count>0){
            // categories available
            while($row=mysqli_fetch_assoc($res)){
                // Get indivdual data;
                $id=$row['id'];
                $title=$row['tittle'];
                $image=$row['image_name'];
                echo'<a href="'.SITEURL.'category-foods.php?categoryid='.$id.'">
                <div class="box-3 float-container">';
                if($image!=""){
                    // image available and dispaly it
                   echo '<img src="'.SITEURL.'images/category/'.$image.'" alt="Pizza" class="img-responsive img-curve">';
                }else{
                    echo"<div class='error'>
                    <h2>Image Not Available</h2>
                    </div>";
                }
                echo '<h3 class="float-text text-white">'.$title.'</h3>
                </div>
                </a>';
            }
        }else{
            echo" <h2 class='error'>No Category Available</h2>";
        }
        ?>



            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-frontend/footer.php');?>