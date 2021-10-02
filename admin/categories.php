<?php include "includes/header.php" ?>


<body>

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
                       <div class="col-xs-6">
                           <?php
                           if(isset($_POST['submit']))
                           {
                            $cat_title = $_POST['cat_title'];
                               if(empty($cat_title)){
                                   echo "require category";
                               }
                               else{
                                $query = "INSERT INTO category(cat_title) ";
                                $query .= "VALUE('{$cat_title}')";
                                $create_category_query = mysqli_query($connection, $query);
                                if(!$create_category_query)
                                {
                                    die('QUERY FAILED' . mysqli_error($connection));
                                }
                               }
                               }
                           ?>
                           <?php
                           if(isset($_GET['delete']))
                           {
                               $id_cat = $_GET['delete'];
                               $query = "DELETE FROM category WHERE cat_id = {$id_cat} ";
                               $delete_query = mysqli_query($connection, $query);
                               header("Location: categories.php");
                           }
                           
                           ?>
                           <form action="" method="post">
                               <div class="form-group">
                                   <label for="cat_title">Add Categories</label>
                                   <input type="text" class="form-control" name="cat_title">
                               </div>
                               <div class="form-group">                               
                                   <input type="submit" name="submit" class="btn btn-primary" value="Add Categories">
                               </div>
                           </form>
                           <?php if(isset($_GET['edit']))
                            {
                                include "includes/update_categories.php";
                            }
                            ?>

                       </div>

                       <div class="col-xs-6">
                          
                           <table class="table table-bordered table-hover">
                               <thead>
                                   <tr>
                                       <th>Id</th>
                                       <th>category Title</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   
                                <?php
                                $query = "SELECT * FROM category";
                                $select_all_categories = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_assoc($select_all_categories))
                                {
                                $cat_tile = $row['cat_title'];
                                $cat_id = $row['cat_id'];
                                echo "<tr>";
                                echo "<td>{$cat_id}</td>";
                                echo "<td>{$cat_tile}</td>";
                                echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                                echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                                echo "</tr>";
                                }
                                ?>
                               </tbody>
                           </table>
                       </div>
                        <!-- <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol> -->
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
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
