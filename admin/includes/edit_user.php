<?php
if(isset($_GET['user_id']))
{
    $the_user_id = $_GET['user_id'];
}
    $query = "SELECT * FROM users WHERE user_id = {$the_user_id}";
    $select_by_user_id = mysqli_query($connection, $query);
    comfirm($select_by_user_id);
    while($row = mysqli_fetch_assoc($select_by_user_id))
    {
      
        $user_id        = $row['user_id'];
        $username       = $row['username'];
        $user_password  = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname  = $row['user_lastname'];
        $user_email     = $row['user_email'];
        $user_image     = $row['user_image'];
        $user_role      = $row['user_role'];;
    }
    if(isset($_POST['update_user']))
{
    $username        = $_POST['username'];
    $user_password   = $_POST['user_password'];
    $user_firstname  = $_POST['user_firstname'];
    $user_lastname   = $_POST['user_lastname'];
    $user_image      = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_email      = $_POST['user_email'];
    $user_role       = $_POST['user_role'];

move_uploaded_file($user_image_temp, "../images/$user_image" );
if(empty($user_image))
{
    $query = "SELECT * FROM users WHERE user_id = {$the_user_id}";
    $select_image = mysqli_query($connection, $query);
    comfirm($select_image);
    while($row = mysqli_fetch_array($select_image)){
        $user_image = $row['user_image'];
    }
}
$query                 = "SELECT randSalt FROM users";
$select_randsalt_query = mysqli_query($connection, $query);
if(!$select_randsalt_query)
{
    die("QUERY FAILED" . mysqli_error($connection));
}
$row = mysqli_fetch_array($select_randsalt_query);
$salt = $row['randSalt'];
$hashed_password = crypt($user_password, $salt);

    $query = "UPDATE users SET ";
    $query .="username  = '{$username}', ";
    $query .="user_password = '{$hashed_password}', ";
    $query .="user_firstname = '{$user_firstname}', ";
    $query .="user_lastname = '{$user_lastname}', ";
    $query .="user_email   = '{$user_email}', ";
    $query .="user_image= '{$user_image}', ";
    $query .="user_role  = '{$user_role}' ";
    $query .= "WHERE user_id = {$the_user_id} ";

$update_user = mysqli_query($connection,$query);

comfirm($update_user);
echo "<p>Updated User <a href='users.php'>View User</a></p>";

}
    ?>
<form action="" method="post" enctype="multipart/form-data">    
     
      <div class="form-group">
         <label for="username">User name</label>
          <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
      </div>
      <div class="form-group">
         <label for="password">Password</label>
          <input type="text" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
      </div>
      <div class="form-group">
         <label for="user_firstname">First name</label>
          <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
      </div>
      <div class="form-group">
         <label for="user_lastname">Last name</label>
          <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
      </div>
      <div class="form-group">
         <label for="user_email">Email</label>
          <input type="text" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
      </div>
     <div class="form-group">
      <label for="user_role">Role</label>
         <select name="user_role" id="" >
         <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
         <?php
         if($user_role == 'admin'){
             echo "<option value='user'>user</option>";
         }
         else
         {
            echo "<option value='admin'>admin</option>";
         }
         ?>
         
         </select>
         </div>
         <div class="form-group">
      <img width="100" src="../images/<?php echo $user_image ?>" alt="">
      </div>
    <div class="form-group">
         <label for="user_image">Update Image</label>
          <input type="file"  name="user_image">
      </div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
      </div>
</form>
    

    