<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>User Role</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    $query = "SELECT * FROM users";
                                    $select_all_roles = mysqli_query($connection, $query);
                                    while($row = mysqli_fetch_assoc($select_all_roles))
                                    {
                                    $user_id = $row['user_id'];
                                    $username = $row['username'];
                                    $user_password = $row['user_password'];
                                    $user_firstname = $row['user_firstname'];
                                    $user_lastname = $row['user_lastname'];
                                    $user_email = $row['user_email'];
                                    $user_image = $row['user_image'];
                                    $user_role = $row['user_role'];
                                    echo "<tr>";
                                    echo "<td>$user_id</td>";
                                    echo "<td>$username</td>";
                                    echo "<td>$user_password</td>";
                                    echo "<td>$user_firstname</td>";
                                    echo "<td>$user_lastname</td>";
                                    echo "<td>$user_email</td>";
                                    echo "<td><img width='100' src='../images/$user_image' alt='image'></td>";
                                    echo "<td>$user_role</td>";
                                    echo " <td><a href='users.php?source=edit_user&user_id={$user_id}'>Update</a></td>";
                                    echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
                                    echo " <td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
                                    echo " <td><a href='users.php?change_to_user=$user_id'>Subcriber</a></td>";
                                    echo "</tr>";
                                    }
                                    
                                    
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                           
                     <?php 
                      if(isset($_GET['change_to_admin']))
                      {
                          $the_admin_id = $_GET['change_to_admin'];
                          $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$the_admin_id}";
                          $update_query = mysqli_query($connection, $query);
                          header("Location: users.php");
                         comfirm($update_query);
                      }
                      if(isset($_GET['change_to_user']))
                      {
                          $the_user_id = $_GET['change_to_user'];
                          $query = "UPDATE users SET user_role = 'user' WHERE user_id = {$the_user_id}";
                          $update_query = mysqli_query($connection, $query);
                          header("Location: users.php");
                         comfirm($update_query);
                      }
                      if(isset($_GET['delete']))
                      {
                          $the_user_id = $_GET['delete'];
                          $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
                          $delete_query = mysqli_query($connection, $query);
                          header("Location: users.php");
                         //  if(!$delete_query){
                         //      die("QUERY FAILED" . mysqli_error($connection));
                         //  }
                         comfirm($delete_query);
                      }
                     ?>