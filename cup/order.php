<?php include('partials-frontend/_navbar.php');?>
    <!-- fOOD sEARCH Section Starts Here -->
    <?php
    // check wether food id is set or not
    if(isset($_GET['food_id'])){
    // get food id
    $food_id=$_GET['food_id'];

    // get the details of the selected food id
    $sql="SELECT * FROM `tbl_food` WHERE id=$food_id";
    $res=mysqli_query($con,$sql);
    $count=mysqli_num_rows($res);
        if($count>0){
            // we have data
            $row=mysqli_fetch_assoc($res);
            $foodtitle=$row['tittle'];
            $price=$row['price'];
            $img=$row['image_name'];
            // $cat_id=$row['category_id'];
        }else{
            // no data for the given id so redirect
            header('location:'.SITEURL);
        }

    }else{
        // redirect to home
        header('location:'.SITEURL);
    }
     ?>
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="post" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        // check wether image avaialble or not
                        if($img!=""){
                            // image available

                            echo'<img src="'.SITEURL.'images/food/'.$img.'" alt="Chicke Hawain Pizza" class="img-responsive img-curve">';
                        }else{
                            echo"<div class='error'>Image Not Available</div>";
                        }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $foodtitle;?></h3>
                        <input type="hidden" name="food" value="<?php echo $foodtitle;?>">
                        <p class="food-price">$<?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
        <?php
        if(isset($_POST['submit'])){
            // echo "clickd";
            $food=$_POST['food'];
            $price=$_POST['price'];
            $qty=$_POST['qty'];
            $total=$price * $qty;
            $order_date=date('Y.m.d h:i:sa');//order date
            $status="ordered";//ordered ,on delivery, delivered ,cancelled
            $customer_name=$_POST['full-name'];
            $customer_contact=$_POST['contact'];
            $customer_email=$_POST['email'];
            $customer_address=$_POST['address'];
            // save the order in sql
            $sql2="INSERT INTO `tbl_order` (`food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ( '$food', $price, $qty, $total, '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";
            $res2=mysqli_query($con,$sql2);
            if($res2){
                // order inserted
                $_SESSION['food-order']="<div class='text-center'><h2 class='success'>Food Ordered Successfully</h2></div>";
                header('location:'.SITEURL);
            }else{
                // failed to save order
                $_SESSION['food-order']="<div class='error text-center'>Failed to Order Food</div>";
                header('location:'.SITEURL);
            }
        }
        ?>                
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-frontend/footer.php');?>