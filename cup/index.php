<?php include('partials-frontend/_navbar.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <!-- order session -->
    <?php
    if(isset($_SESSION['food-order'])){
        echo '<br>';
        echo $_SESSION['food-order']; 
        unset($_SESSION['food-order']);// Removing session 
    }
    
    ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
        <?php
        // create sql query to get data from database 
        $sql="SELECT * FROM `tbl_category` WHERE active='Yes' AND featured='Yes' LIMIT 3";
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
                    echo"<div class='error'>Image Not Available</div>";
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

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
        <?php
        // get food data using from database
            $sql2="SELECT * FROM `tbl_food` WHERE active='Yes' AND featured='Yes' LIMIT 6";
            $res2=mysqli_query($con,$sql2); 

            $count2=mysqli_num_rows($res2);
            if($count2>0){
                // food available
                while($row=mysqli_fetch_assoc($res2)){
                    // get all the details
                    $id=$row['id'];
                    $foodtitle=$row['tittle'];
                    $desc=$row['discription'];
                    $price=$row['price'];
                    $img=$row['image_name'];
                    $cat_id=$row['category_id'];
                    echo '<div class="food-menu-box">
                    <div class="food-menu-img">';
                    if($img!=''){
                     echo'<img src="'.SITEURL.'images/food/'.$img.'" alt="Chicke Hawain Pizza" class="img-responsive img-curve">';
                    }else{
                        echo"<div class='error'><h3>Image Not Available</h3></div>";
                    }
                    echo  '</div> 
                    <div class="food-menu-desc">
                        <h4>'.$foodtitle.'</h4>
                        <p class="food-price">$'.$price.'</p>
                        <p class="food-detail">
                        '.$desc.'
                        </p>
                        <br>
    
                        <a href="'.SITEURL.'order.php?food_id='.$id.'" class="btn btn-primary">Order Now</a>
                    </div>
                </div>';
                }
            }else{
                // food not available
                echo" <div class='error'><h3>No Food Available</h3></div>";
            }
        ?>  
            

            


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    
    <?php include('partials-frontend/footer.php');?>