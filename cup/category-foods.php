<?php include('partials-frontend/_navbar.php');?>
<?php
// check wether id is passed or not
    if(isset($_GET['categoryid'])){
        // catgeory id is set  and get the id
        $catid=$_GET['categoryid'];
        $sql="SELECT tittle FROM tbl_category WHERE id=$catid";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($res);
        $cat_title=$row['tittle'];
    }else{
        // redirect to home page
        header('location:'.SITEURL);
    }
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $cat_title;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
        // get food data using from database
            $sql2="SELECT * FROM `tbl_food` WHERE category_id=$catid";
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
                echo" <div class='error'><h3>No Food Available for '.$title.'</h3></div>";
            }
        ?>



            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-frontend/footer.php');?>