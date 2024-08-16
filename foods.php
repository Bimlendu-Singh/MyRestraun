<?php include('partials-front/menu.php') ?>


    <!-- Food Search Section Starts Here -->
    <section class="food-search">
      <div class="container">
        <div class="search text-allign-center">
          <form action="<?php echo SITEURL; ?>food-search.php" method="post">
            <input
              class="search-box"
              type="search"
              name="search"
              placeholder="Search food item..."
            />
            <input
              class="btn btn-primary"
              type="submit"
              name="submit"
              value="search"
            />
          </form>
        </div>
      </div>
    </section>
    <!-- Food Search Section Ends Here -->
    <br />
    <br />

    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
      <div class="container overflow">
        <h2 style="color: yellow" class="text-allign-center">Explore Food</h2>

        <?php 
                //Display Foods that are Active
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                //Execute the Query
                $res=mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //CHeck whether the foods are availalable or not
                if($count>0)
                {
                    //Foods Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    //CHeck whether image available or not
                                    if($image_name=="")
                                    {
                                        //Image not Available
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Image Available
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
                    //Food not Available
                    echo "<div class='error'>Food not found.</div>";
                }
            ?>

      </div>
    </section>
    <!-- Food Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ?>
