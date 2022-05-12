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



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
    <?php
    // get foods which are active
    $sql="SELECT * FROM `tbl_food` WHERE active='Yes'";
    // execute the query
    $res=mysqli_query($con,$sql);
    $count=mysqli_num_rows($res);
    if($count>0){
        // food available
        while($row=mysqli_fetch_assoc($res)){
            $id=$row['id'];
            $foodtitle=$row['tittle'];
            $desc=$row['discription'];
            $price=$row['price'];
            $img=$row['image_name'];
            echo'<div class="food-menu-box">
            <div class="food-menu-img">';
            if($img!=""){
                // display image
                echo'<img src="'.SITEURL.'images/food/'.$img.'" alt="'.$foodtitle.'" class="img-responsive img-curve">';
            }else{
                echo"<div class='error'><h3>Image Not Available</h3></div>";                
            }
            
            echo'</div>

            <div class="food-menu-desc">
                <h4>'.$foodtitle.'</h4>
                <p class="food-price">$'.$price.'</p>
                <p class="food-detail">
                    '.$desc.'
                </p>
                <br>

                <a href="'.SITEURL.'order.php?food_id='.$id.'" class="btn btn-primary">Order Now</a>
            </div>
        </div> ';
        }
    }else{
        // food not available
        echo"<div class='error'><h3>Food Not Found</h3></div>";
    }
    ?>
            




            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-frontend/footer.php');?>