<?php include('partials-front/menu.php') ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-allign-center">
    <div class="container overflow">

    <?php 
        // Get the search keyword safely
        $search = isset($_POST['search']) ? $_POST['search'] : '';

        // Sanitize and escape the search term for display
        $escaped_search = htmlspecialchars($search, ENT_QUOTES, 'UTF-8');
    ?>

    <h2 style="color: yellow">Foods on Your Search <a href="#" class="text-white">"<?php echo $escaped_search; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container overflow">
        <h2 style="color: yellow" class="text-allign-center">Food Menu</h2>
        <br>

        <?php 
            // Prepare the SQL statement with placeholders
            $sql = "SELECT * FROM tbl_food WHERE title LIKE ? OR description LIKE ?";
            
            // Prepare the statement
            $stmt = mysqli_prepare($conn, $sql);

            // Bind the parameters
            $search_term = "%{$search}%";
            mysqli_stmt_bind_param($stmt, 'ss', $search_term, $search_term);

            // Execute the prepared statement
            mysqli_stmt_execute($stmt);

            // Get the result
            $res = mysqli_stmt_get_result($stmt);

            // Count rows to check whether food is available or not
            $count = mysqli_num_rows($res);

            // Check whether food is available or not
            if($count > 0)
            {
                // Food Available
                while($row = mysqli_fetch_assoc($res))
                {
                    // Get the details
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box overflow">
                        <div class="food-menu-img">
                            <?php 
                                // Check whether image name is available or not
                                if($image_name == "")
                                {
                                    // Image not Available
                                    echo "<div class='error'>Image not Available.</div>";
                                }
                                else
                                {
                                    // Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>image/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" 
                                    class="img-responsive img-curve">
                                    <?php 
                                }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h4>
                            <p class="food-price">$<?php echo htmlspecialchars($price, ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="food-details">
                                <?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>
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
                // Food Not Available
                echo "<div class='text-white text-allign-center'>Food not found.</div>";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        ?>
    </div>
</section>
<!-- Food Menu Section Ends Here -->

<?php include('partials-front/footer.php') ?>
