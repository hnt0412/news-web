
     <?php 
        if(isset($_GET['edit'])){

        $the_cat_id = $_GET['edit'];
        
        $query = "SELECT * FROM category WHERE cat_id = {$the_cat_id}";
        $select_categories_id = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_categories_id))
        {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        }}?>

    <form action="" method="post">
        <div class="form-group">
            <label for="cat_title">Update Categories</label>
            <input value="<?php  echo $cat_title;  ?>" type="text" class="form-control" name="update_title">
            </div>
        <div class="form-group">                               
            <input type="submit" name="update" class="btn btn-primary" value="Update Categories">
        </div>
    </form>      

<?php
if(isset($_POST['update']))
{
    $the_cat_title = $_POST['update_title'];
    $query = "UPDATE category SET cat_title = '{$the_cat_title}' WHERE cat_id = {$the_cat_id}";
    $update_query = mysqli_query($connection, $query);
    if(!$update_query)
    {
        die("QUERY FAILED" . mysqli_error($connection));
    }
}
?>
                                              
                             