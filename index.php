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
    $per_page = 2;
    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }else{
        $page = ""; 
    }
    if($page == "" || $page == 1)
    {
        $page1 = 0;
    }else{
        $page1 = ($page*2) - $per_page;
    }

    $query            = "SELECT * FROM post";
    $find_count       = mysqli_query($connection, $query);
    $count            = mysqli_num_rows($find_count);
    $count            = ceil($count / 2);
    $query            = "SELECT * FROM post LIMIT $page1, $per_page";
    $select_all_posts = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_all_posts))
{
    $post_id      = $row['post_id'];
    $post_title   = $row['post_title'];
    $post_des     = $row['post_description'];
    $post_author  = $row['post_author'];
    $post_content = $row['post_content'];
    $post_image   = $row['post_image'];
    $post_date    = $row['post_date'];
    $post_status  = $row['post_status'];
if($post_status == 'public')
{


?>
    <!-- Blog Entries Column -->
    <!-- <h1 class="page-header">
        Page Heading
        <small>Secondary Text</small>
    </h1> -->
    <!-- First Blog Post -->

    <h2>
        <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
    </h2>
    <p class="lead">
        by <a href="author_posts.php?author=<?php echo $post_author; ?>"><?php echo $post_author ?></a>
    </p>
    <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
   
    <?php if($post_image != ""){
    ?>
     <hr>
     <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image ?>" alt=""></a>
     <hr>
    <?php } ?>
   
    
    <p><?php echo $post_des ?></p>
    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

    <hr>
<?php
}}
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
        <ul class="pager">
           <?php
             for($i = 1; $i <= $count; $i++)
            {
                if($i == $page){
                echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</li>";
            }
            else
            {
                echo "<li><a href='index.php?page={$i}'>{$i}</li>";
            }
        }
           ?>
        </ul>

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
