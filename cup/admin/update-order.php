<?php include('partials/menu.php');?>
<div class="main-content">
<div class="wrapper">
    <h1>Update Order</h1>
<br><br>
        <?php
        if(isset($_GET['id'])){
            // get details
            $id=$_GET['id'];
            // get all other details
            $sql="SELECT * FROM tbl_order WHERE id=$id";
            $res=mysqli_query($con,$sql);
            $count=mysqli_num_rows($res);
            if($count==1){
                // order avialable
                $row=mysqli_fetch_assoc($res);
                $food=$row['food'];
                $price=$row['price'];
                $qty=$row['quantity'];
                $status=$row['status'];
                $cname=$row['customer_name'];
                $contact=$row['customer_contact'];
                $email=$row['customer_email'];
                $add=$row['customer_address'];
            }else{
                // not availbele
                header('location:'.SITEURL.'admin/manage-order.php');
            }

        }else{
            // redirect
            header('location:'.SITEURL.'admin/manage-order.php');
        }
        ?>
    <form action="" method="post">
        
        <table class="tbl-30">
            <tr>
                <td>Food Name</td>
                <td><b><?php echo $food; ?></b></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><b>$ <?php echo $price;?></b></td>
            </tr>
            <tr>
                    <td>Quantity:</td>
                    <td><input type="number" name="qnty" value="<?php echo $qty; ?>" id="" ></td>
            </tr>
            <tr>
                    <td>Status</td>
                    <td> <select name="status" id="">
                        <option <?php if($status=="Ordered"){echo "selected";}?> value="Ordered">Ordered</option>
                        <option <?php if($status=="On Delivery"){echo "selected";}?> value="On Delivery">On Delivery</option>
                        <option <?php if($status=="Delivered"){echo "selected";}?> value="Delivered">Delivered</option>
                        <option <?php if($status=="Cancelled"){echo "selected";}?> value="Cancelled">Cancelled</option>
                    </select>
                    </td>
            </tr>
            <tr>
                    <td>Customer Name:</td>
                    <td><input type="text" name="customer_name" value="<?php echo $cname;?>" ></td>
            </tr>
            <tr>
                    <td>Customer Contact:</td>
                    <td><input type="text" name="c_contact" value="<?php echo $contact; ?>" ></td>
            </tr>
            <tr>
                    <td>Customer Email:</td>
                    <td><input type="text" name="c_email" value="<?php echo $email;?>" ></td>
            </tr>
            <tr>
                    <td>Customer Address:</td>
                    <td><textarea name="c_address" id="" cols="30" rows="5"><?php echo $add;?></textarea></td>
            </tr>
            <tr>
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="hidden" name="price" value="<?php echo $price;?>">
                <input type="submit" name="submit" value="Update Order" class="btn-secondary">
            </td>
            </tr>
        </table>
    </form>
    <?php
    if(isset($_POST['submit'])){
        // echo "clicked";
        // get all the values form the form
        $id=$_POST['id'];
        $price=$_POST['price'];
        $qty=$_POST['qnty'];
        $total=$price*$qty;
        $status=$_POST['status'];
        $cname=$_POST['customer_name'];
        $c_contact=$_POST['c_contact'];
        $c_email=$_POST['c_email'];
        $c_add=$_POST['c_address'];
        // upadte the food order details
        $sql2="UPDATE `tbl_order` SET `quantity` = $qty,`total` = $total,`status` = '$status',`customer_name` = '$cname',`customer_contact` = '$c_contact',`customer_email` = '$c_email',`customer_address` ='$c_add'  WHERE `tbl_order`.`id` = $id";
        $res2=mysqli_query($con,$sql2);
        // check wether query executed or not
        if($res2){
            // order updated
            $_SESSION['update-order']="<div class='success'>Order Updated Successfully</div>";
            header('location:'.SITEURL.'admin/manage-order.php');
        }else{
            // order not updated
            $_SESSION['update-order']="<div class='error'>Failed to updtae orde. Try again later</div>";
            header('location:'.SITEURL.'admin/manage-order.php');
        }
    }
    ?>
    </div>
</div>
<?php include('partials/footer.php');?>