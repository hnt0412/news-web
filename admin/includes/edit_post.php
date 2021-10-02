<?php
if(isset($_GET['p_id']))
{
$the_post_id = $_GET['p_id'];
}
$query = "SELECT * FROM post WHERE post_id = {$the_post_id}";
$select_post_by_id = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($select_post_by_id)){
    $post_author      = $row['post_author'];
    $post_category_id = $row['post_category_id'];
    $post_title       = $row['post_title'];
    $post_description = $row['post_description'];
    $post_content     = $row['post_content'];
    $post_status      = $row['post_status'];
    $post_image       = $row['post_image'];
    $post_tags        = $row['post_tags'];
    $post_date        = $row['post_date'];
}
if(isset($_POST['update_post']))
{
    $post_title        = $_POST['post_title'];
    $post_des          = $_POST['post_des'];
    $post_author       = $_POST['post_author'];
    $post_category_id  = $_POST['post_category_id'];
    $post_status       = $_POST['post_status'];
    $post_image        = $_FILES['image']['name'];
    $post_image_temp   = $_FILES['image']['tmp_name'];
    $post_tags         = $_POST['post_tags'];
    $post_content      = $_POST['post_content'];
    $post_date         = date('d-m-y');

move_uploaded_file($post_image_temp, "../images/$post_image" );
if(empty($post_image))
{
    $query = "SELECT * FROM post WHERE post_id = {$the_post_id}";
    $select_image = mysqli_query($connection, $query);
    comfirm($select_image);
    while($row = mysqli_fetch_array($select_image)){
        $post_image = $row['post_image'];
    }
}
    $query = "UPDATE post SET ";
    $query .="post_title  = '{$post_title}', ";
    $query .="post_description  = '{$post_des}', ";
    $query .="post_category_id = '{$post_category_id}', ";
    $query .="post_date   =  now(), ";
    $query .="post_author = '{$post_author}', ";
    $query .="post_status = '{$post_status}', ";
    $query .="post_tags   = '{$post_tags}', ";
    $query .="post_content= '{$post_content}', ";
    $query .="post_image  = '{$post_image}' ";
    $query .= "WHERE post_id = {$the_post_id} ";

    $update_post = mysqli_query($connection,$query);

comfirm($update_post);
echo "<p>Post Update . <a href='../post.php?p_id={$the_post_id}'>View Post</a> Or <a href='posts.php'>Update More Post</a></p>";
}
?>

<form action="" method="post" enctype="multipart/form-data">    
     
      <div class="form-group">
         <label for="post_author">Post Author</label>
          <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
      </div>
      <div class="form-group">
      <label for="title">Post Title</label>
          <input type="text" class="form-control" name="post_title" value="<?php echo $post_title;?>" >
      </div>
      <div class="form-group">
      <label for="post_des">Post Description</label>
          <input type="text" class="form-control" name="post_des" value="<?php echo $post_description;?>" >
      </div>
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control "name="post_content" id="" cols="30" rows="10"><?php echo $post_content;?></textarea>
      </div>
         <div class="form-group">
         <select name="post_category_id" id="" >
         <?php
         $query = "SELECT * FROM category";
         $select_all_categories = mysqli_query($connection, $query);
         comfirm($select_all_categories);
         while($row = mysqli_fetch_assoc($select_all_categories))
         {
         $cat_title = $row['cat_title'];
         $cat_id    = $row['cat_id'];
         echo "<option value='$cat_id'>{$cat_title}</option>";
         }
         ?>
         </select>
         </div>
      
      
       <div class="form-group">
           <label for="post_status">Post Status</label>
           <select name="post_status" id="">
           <option value='<?php echo $post_status ?>'><?php echo $post_status; ?></option>
           <?php
           if($post_status == 'public')
           {
            echo "<option value='draft'>draft</option>";
           }
           else
           {
            echo "<option value='public'>public</option>";
           }
           ?>
           </select>
       <!-- <input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>" > -->
      </div>
      
      <div class="form-group">
      <img width="100" src="../images/<?php echo $post_image ?>" alt="">
      </div>
      <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" name="post_tags" class="form-control" value="<?php echo $post_tags; ?>" >
      </div>

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
      </div>


</form>

