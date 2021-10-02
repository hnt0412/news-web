
    <?php include "includes/header.php" ?>
<div id="wrapper">
    <?php include "includes/navigation.php" ?>
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
<h1 class="page-header">
            Welcome to admin
            <small>Author</small>
        </h1>
    </div>
    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Comment ID</th>
                                    <th>Author</th>
                                    <th>Post id</th>
                                    <th>Content</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>View Post</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    if(isset($_GET['id'])){
                                    $comment_post_id = $_GET['id'];
                                    }
                                    // $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($_GET['id']). " ";
                                    $query = "SELECT * FROM comments WHERE comment_post_id = $comment_post_id ";
                                    $select_all_comments = mysqli_query($connection, $query);
                                    while($row = mysqli_fetch_assoc($select_all_comments)){
            
                                    $comment_id = $row['comment_id'];
                                    $comment_author = $row['comment_author'];
                                    $comment_post_id = $row['comment_post_id'];
                                    $comment_content = $row['comment_content'];
                                    $comment_email = $row['comment_email'];
                                    $comment_status = $row['comment_status'];
                                    $comment_date = $row['comment_date'];
                                    echo "<tr>";
                                    echo "<td>$comment_id</td>";
                                    echo "<td>$comment_author</td>";
                                    echo "<td>$comment_post_id</td>";
                                    echo "<td>$comment_content</td>";
                                    echo "<td>$comment_email</td>";
                                    echo "<td>$comment_status</td>";
                                    $query = "SELECT * FROM post WHERE post_id = {$comment_post_id}";
                                    $select_all_posts = mysqli_query($connection, $query);
                                    $row = mysqli_fetch_assoc($select_all_posts);
                                    $post_id = $row['post_id'];
                                    $post_title = $row['post_title'];
                                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                                    echo "<td>$comment_date</td>";
                                    echo " <td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                                    echo " <td><a href='comments.php?unapprove=$comment_id'>UnApprove</a></td>";
                                    echo " <td><a href=''>Update</a></td>";
                                    echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
                                    echo "</tr>";
                                    }
                                    ?>
                                </tr>
                            </tbody>
                        </table>     
                     <?php 
                      if(isset($_GET['approve']))
                      {
                          $the_approve_id = $_GET['approve'];
                          $query = "UPDATE comments SET comment_status = 'approve' WHERE comment_id = {$the_approve_id}";
                          $update_query = mysqli_query($connection, $query);
                          header("Location: comments.php");
                         comfirm($update_query);
                      }
                      if(isset($_GET['unapprove']))
                      {
                          $the_unapprove_id = $_GET['unapprove'];
                          $query = "UPDATE comments SET comment_status = 'unapprove' WHERE comment_id = {$the_unapprove_id}";
                          $update_query = mysqli_query($connection, $query);
                          header("Location: comments.php");
                         comfirm($update_query);
                      }
                      if(isset($_GET['delete']))
                      {
                          $the_comment_id = $_GET['delete'];
                          $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
                          $delete_query = mysqli_query($connection, $query);
                          header("Location: comments.php");
                         //  if(!$delete_query){
                         //      die("QUERY FAILED" . mysqli_error($connection));
                         //  }
                         comfirm($delete_query);
                      }
                     ?>
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



