
<?php 
if(isset($_POST['create_post'])) {
   
    $post_title        = $_POST['title'];
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

$query             = "INSERT INTO post(post_category_id,post_author, post_title, post_date,post_image,post_content,post_tags,post_status) ";   
$query            .= "VALUES({$post_category_id},'{$post_author}', '{$post_title}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') ";  
$create_post_query = mysqli_query($connection, $query);  
comfirm($create_post_query);
$the_post_id = mysqli_insert_id($connection);
echo "<p><a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php?source=edit_post&p_id={$the_post_id}'>Update more Post</a></p>";
}
?>

<form action="" method="post" enctype="multipart/form-data">    
     
      <div class="form-group">
         <label for="post_author">Post Author</label>
          <input type="text" class="form-control" name="post_author">
      </div>
      <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="title">
      </div>
      <div class="form-group">
         <label for="post_des">Post Title</label>
          <input type="text" class="form-control" name="post_des">
      </div>
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control "name="post_content" id="body" cols="30" rows="10">
         </textarea>
      </div>
      <div class="form-group">
      <label for="post_category_id">Category</label>
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
           <option value="draft">Draft</option>
           <option value="public">Public</option>
           </select>
       </div>
      
       <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags">
      </div>

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Create Post">
      </div>


</form>
    