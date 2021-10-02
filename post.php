<?php
    include "includes/db.php";
    ?>
<!DOCTYPE html>
<html lang="en">

<?php
include "includes/header.php";
?>

<body>

    <!-- Navigation -->
    <?php
    include "includes/navigation.php"
    ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">
        <div class="col-md-8">
            
                <?php
                if(isset($_GET['p_id']))
                {
                    $the_post_id = $_GET['p_id'];
                    $query = "UPDATE post SET post_views_count = post_views_count + 1 WHERE post_id =$the_post_id ";
                    $send_query = mysqli_query($connection,$query);
                }
  
                $query = "SELECT * FROM post WHERE post_id = {$the_post_id}";
                $select_all_posts = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_all_posts))
                {
                $post_title   = $row['post_title'];
                $post_author  = $row['post_author'];
                $post_content = $row['post_content'];
                $post_image   = $row['post_image'];
                $post_date    = $row['post_date'];
                ?>

               <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"><?php echo $post_date ?></span></p>
                <?php if($post_image != ""){
                ?>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image ?>" alt=""></a>
                <hr>
                <?php } ?>
                <p><?php echo $post_content ?></p>
                <hr>

<?php
}
?>


<?php
if(isset($_POST['create_comment']))
{
    $the_post_id     = $_GET['p_id'];
    $comment_author  = $_POST['comment_author'];
    $comment_email   = $_POST['email'];
    $comment_content = $_POST['comment_content'];

    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
    $query.= "VALUES($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'approve', now())";
    $create_comment_query = mysqli_query($connection, $query);
    if(!$create_comment_query)
    {
        die("QUERY FAILED" . mysqli_error($connection));
    }
}
else{
    echo "<script>alert('Feilds cannot be empty')</script>";
}
}
?>
  <!-- Blog Comments -->
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                        <label for="comment_author">Author</label>
                        <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="comment_content">Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                if(isset($_GET['p_id']))
                {
                    $the_post_id = $_GET['p_id'];
                }
                $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                $query.= "AND comment_status = 'approve' ";
                $query.= "ORDER BY comment_id DESC ";
                $select_comments = mysqli_query($connection, $query);
                if(!$select_comments)
                {
                    die("QUERY FAILED" . mysqli_error($connection));
                }
                while($row = mysqli_fetch_assoc($select_comments))
                {
                $comment_id = $row['comment_id'];
                $comment_author = $row['comment_author'];
                $comment_post_id = $row['comment_post_id'];
                $comment_content = $row['comment_content'];
                $comment_email = $row['comment_email'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];
                ?>
 <!-- Comment -->
 <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                </div>
 </div>

                <!-- Comment -->

  <?php } ?>
               
              


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php
            include "includes/sidebar.php"
            ?>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
       <?php
       include "includes/footer.php";
       ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
