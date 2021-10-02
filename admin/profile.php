
    <?php include "includes/header.php" ?>
   
<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>
<div id="page-wrapper">
<div class="container-fluid">
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
<h1 class="page-header">
            Welcome to admin
            <small>Author</small>
        </h1>
    </div>
    <?php
 if(isset($_SESSION['username']))
 {
     $the_username = $_SESSION['username'];
 } 
    $query = "SELECT * FROM users WHERE username = '{$the_username}'";
    $select_by_username = mysqli_query($connection, $query);
    comfirm($select_by_username);
    while($row = mysqli_fetch_assoc($select_by_username))
    {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];;
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
    $query = "SELECT * FROM users WHERE username = '{$the_username}'";
    $select_image = mysqli_query($connection, $query);
    comfirm($select_image);
    while($row = mysqli_fetch_array($select_image)){
        $user_image = $row['user_image'];
    }
}
        $query = "UPDATE users SET ";
        $query .="username  = '{$username}', ";
        $query .="user_password = '{$user_password}', ";
        $query .="user_firstname = '{$user_firstname}', ";
        $query .="user_lastname = '{$user_lastname}', ";
        $query .="user_email   = '{$user_email}', ";
        $query .="user_image= '{$user_image}', ";
        $query .="user_role  = '{$user_role}' ";
        $query .= "WHERE username = '{$the_username}' ";

        $update_user = mysqli_query($connection,$query);
        comfirm($update_user);
}
    ?>


<form action="" method="post" enctype="multipart/form-data">    
     
      <div class="form-group">
         <label for="username">User name</label>
          <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
      </div>
      <div class="form-group">
         <label for="password">Password</label>
          <input type="password" class="form-control" name="user_password" value="<?php echo $user_password ?>">
      </div>
      <div class="form-group">
         <label for="user_firstname">First name</label>
          <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
      </div>
      <div class="form-group">
         <label for="user_lastname">Last name</label>
          <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
      </div>
      <div class="form-group">
         <label for="user_email">Email</label>
          <input type="text" class="form-control" name="user_email" value="<?php echo $user_email ?>">
      </div>
      <div class="form-group">
      <label for="user_role">Role</label>
         <select name="user_role" id="" >
         <option value="user"><?php echo $user_role ?></option>
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
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
    <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
     <script src="js/scripts.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>



