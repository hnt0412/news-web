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
                if(isset($_GET['author']))
                {
                    // $the_post_id = $_GET['p_id'];
                    $the_post_author = $_GET['author'];
                }
                    $query = "SELECT * FROM post WHERE post_author = '{$the_post_author}' ";
                    $select_all_posts = mysqli_query($connection, $query);
                    if(!$select_all_posts)
                    {
                    die("QUERY FAILED" . mysqli_error($connection));
                    }
                    while($row = mysqli_fetch_assoc($select_all_posts))
                    {
                    $post_title   = $row['post_title'];
                    $post_author  = $row['post_author'];
                    $post_content = $row['post_content'];
                    $post_image   = $row['post_image'];
                    $post_date    = $row['post_date'];
                    ?>
            <!-- Blog Entries Column -->
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->

               <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <hr>
<?php
}
?>
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
