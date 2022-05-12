<?php include('partials-frontend/_navbar.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
  <?php
  $search=$_POST['search'];
  ?>          
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
    <?php
    // get the search keyword 
    
    $sql="SELECT * FROM tbl_food WHERE tittle like '%$search%' OR discription like '%$search%'";
    $res=mysqli_query($con,$sql);
    // count rows
    $count=mysqli_num_rows($res);
    // check wether food available or not
    if($count>0){
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
             echo '</div>

             <div class="food-menu-desc">
                 <h4>'.$foodtitle.'</h4>
                 <p class="food-price">$'.$price.'</p>
                 <p class="food-detail">
                    '.$desc.'
                 </p>
                 <br>

                 <a href="#" class="btn btn-primary">Order Now</a>
             </div>
         </div>';
        }
    }else{
        // food not available
        echo"<div class='error'><h2>Food Not Found</h2></div>";
    }
    ?>
            



            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-frontend/footer.php');?>