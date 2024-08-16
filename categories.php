<?php include ('partials-front/menu.php') ?>

<!-- Categories Section Starts Here -->
<section class="Categories">
    <div class="container overflow">
        <h2 class="text-allign-center">Categories</h2>

        <?php

        //Display all the categories that are active
        //SQL Query
        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Count Rows
        $count = mysqli_num_rows($res);

        //Check whether categories are available or not
        if ($count > 0) {
            //Categories Available
            while ($row = mysqli_fetch_assoc($res)) {
                //Get the Values
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
                ?>

                <!-- Corrected href link -->
                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        if ($image_name == "") {
                            //Image not Available
                            echo "<div class='error'>Image not found.</div>";
                        } else {
                            //Image Available
                            ?>
                            <!-- Removed nested <a> tag -->
                            <img src="<?php echo SITEURL; ?>image/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"
                                class="img-responsive img-curve image">
                            <?php
                        }
                        ?>

                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>

                <?php
            }
        } else {
            //Categories Not Available
            echo "<div class='error'>Category not found.</div>";
        }

        ?>

    </div>

</section>
<!-- Categories Section Ends Here -->

<?php include ('partials-front/footer.php') ?>
