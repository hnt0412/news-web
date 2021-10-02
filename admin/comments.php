
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
                if(isset($_GET['source'])){
                $source = $_GET['source'];
                } else {
                $source = '';
                }
                switch($source) {
                case 'add_post';
                    include "includes/add_posts.php";
                break; 
                case 'edit_post';
                    include "includes/edit_post.php";
                break;
                case '200';
                     echo "NICE 200";
                break;
                default:
                include "includes/view_all_comments.php";
                break;
                }
                ?> 
      </div>
    </div>
</div>
</div>
</div>  
     <script src="js/scripts.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>



