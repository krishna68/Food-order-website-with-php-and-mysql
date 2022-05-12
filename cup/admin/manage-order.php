<?php include('partials/menu.php');?>
<!-- Main section -->
<div class="main-content">
<div class="wrapper">
    <h1>Manage Order</h1>


<br/>
<br/>
    <?php
    if(isset($_SESSION['update-order'])){
                echo $_SESSION['update-order'];
                echo '<br><br>';
                unset($_SESSION['update-order']);// Removing session  
            }
    ?>
<table class="tbl-full">
<tr>
    <th>S.N.</th>
    <th>Food</th>
    <th>Price</th>
    <th>Qty</th>
    <th>Total</th>
    <th> Order Date</th>
    <th>Order Status</th>
    <th>Customer Name</th>
    <th>Customer Contact</th>
    <th>Customer Email</th>
    <th>Address</th>
    <th>Actions</th>
</tr>
<?php
// get order details
    $sql="SELECT * FROM `tbl_order` ORDER BY  id DESC";//display latest order 
    $res=mysqli_query($con,$sql);
    $count=mysqli_num_rows($res);   
    if($count>0){
        // orders available
        $sn=1;
        while($row=mysqli_fetch_assoc($res)){
            $id=$row['id'];
            $food=$row['food'];
            $price=$row['price'];
            $qty=$row['quantity'];
            $total=$row['total'];
            $date=$row['order_date'];
            $status=$row['status'];
            $cname=$row['customer_name'];
            $contact=$row['customer_contact'];
            $email=$row['customer_email'];
            $add=$row['customer_address'];
            // displaying details
            echo'<tr>
            <td>'.$sn++.'</td>
            <td>'.$food.'</td>
            <td>$'.$price.'</td>
            <td>'.$qty.'</td>
            <td>$'.$total.'</td>
            <td>'.$date.'</td><td>';
            if($status=="Ordered"){
                echo '<label>'.$status.'</label>';
            }elseif($status=="On Delivery"){
                echo "<label style='color: orange'>$status</label>";
            }elseif($status=="Delivered"){
                echo "<label style='color: green'>$status</label>";
            }elseif($status=="Cancelled"){
                echo "<label style='color: red'>$status</label>";
            }
            // '.$status.'
            echo'</td><td>'.$cname.'</td>
            <td>'.$contact.'</td>
            <td>'.$email.'</td>
            <td>'.$add.'</td>
            <td >
                <a href="'.SITEURL.'admin/update-order.php?id='.$id.'" class="btn-secondary">Update Order</a>

            </td>
        </tr>';
        }
    }else{
    // order not available        
    echo '<tr>
        <td colspan="12" class="error">No Order Available</td>
        </tr>';
    }

?>




</table>

</div>
</div>

        <!-- Main section ends-->


<?php include('partials/footer.php');?>