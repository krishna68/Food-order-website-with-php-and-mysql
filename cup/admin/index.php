<?php include('partials/menu.php'); ?>


        <!-- Main section -->
        <div class="main-content">
            <div class="wrapper"><h1>Dashborad</h1>
            <br>
            <?php
             if(isset($_SESSION['login'])){
                echo $_SESSION['login'].'<br>';
                unset ($_SESSION['login']);
            }
            ?>
        
        <div class="boxes">
            <?php
            // sql query
             $sql="SELECT * FROM `tbl_category`";
             $res=mysqli_query($con,$sql);
             $count=mysqli_num_rows($res);
            ?>
        <div class="col-4 text-center">
            <h1><?php echo $count;?></h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
        <?php
            // sql query
             $sql2="SELECT * FROM `tbl_food`";
             $res2=mysqli_query($con,$sql2);
             $count2=mysqli_num_rows($res2);
            ?>
            <h1><?php echo $count2;
             ?></h1>
            <br>
            Foods
        </div>
        <div class="col-4 text-center">
            <?php
            // sql query
             $sql3="SELECT * FROM `tbl_order`";
             $res3=mysqli_query($con,$sql3);
             $count3=mysqli_num_rows($res3);
            ?>
            <h1><?php echo $count3;?></h1>
            <br>
            Total Orders
        </div>
        <div class="col-4 text-center">
        <?php
        // sql query to get revenue
        // agreate function in sql
        $sql4="SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
        $res4=mysqli_query($con,$sql4);
        $count4=mysqli_num_rows($res4);
        if($count4>0){

            $row=mysqli_fetch_assoc($res4);
            $total_revenue=$row['Total'];   
        }else{
            $total_revenue= 0.00;
        }
        ?>    
        <h1>$ <?php echo $total_revenue; ?></h1>
            <br>
            Revenue Generated
        </div>
        </div>
        </div>
        </div>

        <!-- Main section ends-->

<?php include('partials/footer.php');?>