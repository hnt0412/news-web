
<?php 
if(isset($_POST['create_user'])) {
   
    $username        = $_POST['username'];
    $user_password   = $_POST['user_password'];
    $user_firstname  = $_POST['user_firstname'];
    $user_lastname   = $_POST['user_lastname'];
    $user_image      = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_email      = $_POST['user_email'];
    $user_role       = $_POST['user_role'];

move_uploaded_file($user_image_temp, "../images/$user_image" );

$query = "INSERT INTO users(username,user_password, user_firstname, user_lastname,user_image,user_email,user_role) ";
$query .= "VALUES('{$username}','{$user_password}', '{$user_firstname}','{$user_lastname}','{$user_image}','{$user_email}', '{$user_role}') ";  
$create_user_query = mysqli_query($connection, $query);  
comfirm($create_user_query);
echo "Create User: " . " " . "<a href='users.php'>View Users</a>";
if(!$create_post_query)
{
    die("QUERY FAILED" . mysqli_error($connection));
}
}
?>

<form action="" method="post" enctype="multipart/form-data">    
     
      <div class="form-group">
         <label for="username">User name</label>
          <input type="text" class="form-control" name="username">
      </div>
      <div class="form-group">
         <label for="password">Password</label>
          <input type="text" class="form-control" name="user_password">
      </div>
      <div class="form-group">
         <label for="user_firstname">First name</label>
          <input type="text" class="form-control" name="user_firstname">
      </div>
      <div class="form-group">
         <label for="user_lastname">Last name</label>
          <input type="text" class="form-control" name="user_lastname">
      </div>
      <div class="form-group">
         <label for="user_email">Email</label>
          <input type="text" class="form-control" name="user_email">
      </div>
      <div class="form-group">
      <label for="user_role">Role</label>
         <select name="user_role" id="" >
         <option value="subcriber">Select Option</option>
         <option value="subcriber">Subcriber</option>
         <option value="admin">Admin</option>
         </select>
         </div>
      
    <div class="form-group">
         <label for="user_image">Post Image</label>
          <input type="file"  name="user_image">
      </div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_user" value="Create User">
      </div>


</form>
    