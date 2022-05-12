<?php include('partials/menu.php');?>

        <!-- Main section -->
        <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <br/>

<!-- Button to add admin -->
<a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">+Add Food</a>
<br/>
<br/>
<?php
if(isset($_SESSION['add-food'])){
    echo $_SESSION['add-food'];
    echo '<br><br>';
    unset($_SESSION['add-food']);// Removing session 
}

if(isset($_SESSION['delete'])){
    echo $_SESSION['delete'];
    echo '<br>';
    unset($_SESSION['delete']);// Removing session 
}
if(isset($_SESSION['remove'])){
    echo $_SESSION['remove'];
    echo '<br>';
    unset($_SESSION['remove']);// Removing session 
}
if(isset($_SESSION['no-food'])){
    echo $_SESSION['no-food'];
    echo '<br>';
    unset($_SESSION['no-food']);// Removing session 
}
if(isset($_SESSION['upload'])){
    echo $_SESSION['upload'];
    echo '<br>';
    unset($_SESSION['upload']);// Removing session 
}
if(isset($_SESSION['update'])){
    echo $_SESSION['update'];
    echo '<br>';
    unset($_SESSION['update']);// Removing session 
}
?>
<table class="tbl-full">
<tr>
    <th>S.N.</th>
    <th>Title</th>
    <th>Price</th>
    <th>Image</th>
    <th>Featured</th>
    <th>Active</th>
    <th>Actions</th>
</tr>

<?php
// get food data using from database
$sql="SELECT * FROM `tbl_food`";
$res=mysqli_query($con,$sql);

$count=mysqli_num_rows($res);
if($count>0){
        // we have data in database
        // using while loop to display data
        $sn=1;
        while($row=mysqli_fetch_assoc($res)){
            // Get indivdual data;
            $id=$row['id'];
            $title=$row['tittle'];
            $price=$row['price'];
            $image=$row['image_name'];
            $featured=$row['featured'];
            $active=$row['active'];
     echo '<tr>
     <td>'.$sn++.'</td>
     <td>'.$title.'</td>
     <td>'.$price.'</td>
     <td>';
     if($image!=""){
        // display image
?>
<img src="<?php echo SITEURL;?>images/food/<?php echo $image;?>" width ="100px" alt="">
<?php
     }else{
        //  show error
        echo '<div class="error">Image not added</div>';
     }
     echo'</td>
                 <td>'.$featured.'</td>
                 <td>'.$active.'</td>
                 <td >
                     <a href="'.SITEURL.'admin/update-food.php?id='.$id.'" class="btn-secondary">Update Category</a>
                     <a href="'.SITEURL.'admin/delete-food.php?id='.$id.'&image_name='.$image.'" class="btn-danger">Delete Category</a>
 
                 </td>
             </tr>';
}
   
}else{
    echo " <tr><td colspan='7' class='error'>Food Not Added Yet</td></tr>";
    //echo meessgae
}
?>


</table>

       
        </div>
        </div>

        <!-- Main section ends-->


<?php include('partials/footer.php');?>