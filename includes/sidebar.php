<div class="col-md-4">
<?php
// $search = $_POST['search'];
// $query = "SELECT * FROM post WHERE post_tags LIKE '%{$search}%'";
// $search_query = mysqli_query($connection, $query);
// if(!$search_query)
// {
//     die("QUERY FAILED" . mysqli_error($connection));
// }
// $count = mysqli_num_rows($search_query);
// if($count == 0)
// {
//     echo "<h1> NO CONTENT </h1>";
// }
// else
// {
//     echo "some";
// }
?> 
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog login Well -->
                <div class="well">
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">
                    <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Enter Username">
                    </div>
                    <div class="input-group">
                    <input name="password" type="password" class="form-control" placeholder="Enter Password">
                    
                        <span class="input-group-btn">
                            <button name="login" class="btn btn-primary" type="submit">Submit
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>
 
                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php
                                $query = "SELECT * FROM category";
                                $select_all_categories = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_assoc($select_all_categories))
                                {
                                $cat_tile = $row['cat_title'];
                                $cat_id   = $row['cat_id'];
                                echo "<li><a href='category.php?category={$cat_id}'>{$cat_tile}</a></li>";
                                }
                                ?>
                            </ul>
                        </div>

                    
                        <!-- /.col-lg-6 -->
                        
                        <!-- /.col-lg-6 -->