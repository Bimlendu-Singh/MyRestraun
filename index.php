<?php 
ob_start();
include('partials-front/menu.php'); 
?>

<!-- Food Search Section Starts Here -->
<section class="food-search">
    <div class="container">
        <div class="search text-allign-center">
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input class="search-box" type="search" name="search" placeholder="Search food item..." />
                <input class="btn btn-primary" type="submit" name="submit" value="search" />
            </form>
        </div>
    </div>
</section>
<!-- Food Search Section Ends Here -->

<!-- Display Order Message -->
<?php 
if(isset($_SESSION['order']))
{
    echo "<div style='margin: 20px auto; padding: 15px; width: 30%; text-align: center; background-color: #4CAF50; color: white; font-size: 18px; border-radius: 8px;'>
            " . $_SESSION['order'] . "
          </div>";
    unset($_SESSION['order']);
}
?>

<!-- Categories Section Starts Here -->
<section class="Categories">
    <div class="container overflow">
        <h2 class="text-allign-center">Categories</h2> 

        <?php 
            // Create SQL Query to Display Categories from Database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            // Execute the Query
            $res = mysqli_query($conn, $sql);
            // Count rows to check whether the category is available or not
            $count = mysqli_num_rows($res);

            if($count>0)
            {
                // Categories Available
                while($row=mysqli_fetch_assoc($res))
                {
                    // Get the Values like id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    
                    <!-- Update the href to include the category_id -->
                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php 
                                // Check whether Image is available or not
                                if($image_name=="")
                                {
                                    // Display Message
                                    echo "<div class='error'>Image not Available</div>";
                                }
                                else
                                {
                                    // Image Available
                                    ?>
                                    <img class="img-responsive img-curve image" src="<?php echo SITEURL; ?>image/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" >
                                    <?php
                                }
                            ?>
                            <h3 class="text-allign-center float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>

                    <?php
                }
            }
            else
            {
                // Categories not Available
                echo "<div class='error'>Category not Added.</div>";
            }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- Food Menu Section Starts Here -->
<section class="food-menu">
    <div class="container overflow">

        <h2 style="color: yellow;" class="text-allign-center">Explore Food</h2>

        <?php 
        // Getting Foods from Database that are active and featured
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);

        if($count2>0)
        {
            // Food Available
            while($row=mysqli_fetch_assoc($res2))
            {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php 
                        if($image_name=="")
                        {
                            echo "<div class='error'>Image not available.</div>";
                        }
                        else
                        {
                            ?>
                            <img src="<?php echo SITEURL; ?>image/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">Rs<?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

                <?php
            }
        }
        else
        {
            echo "<div class='error'>Food not available.</div>";
        }
        ?>
    </div>
</section>
<!-- Food Menu Section Ends Here -->

<?php include('partials-front/footer.php') ?>
