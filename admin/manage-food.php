<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper overflow">
        <h1>Manage Food</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <br>
        <!-- Button to Add Food -->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br><br><br>

        <table class="tbl-width-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            // Query to Get all Food from Database
            $sql = "SELECT * FROM tbl_food";
            // Execute Query
            $res = mysqli_query($conn, $sql);

            // Count Rows to Check whether we have foods or not
            $count = mysqli_num_rows($res);

            // Create Serial Number Variable and Set Default Value as 1
            $sn = 1;

            if ($count > 0) {
                // We have food in Database
                // Get the foods from Database and Display
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $category_id = $row['category_id'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                    // Get category title from category ID

                    // $sql2 = "SELECT title FROM tbl_category WHERE id=$category_id";
                    // $res2 = mysqli_query($conn, $sql2);
                    // $row2 = mysqli_fetch_assoc($res2);
                    // $category_title = $row2['title'];

                    $sql2 = "SELECT title FROM tbl_category WHERE id=$category_id";
                    $res2 = mysqli_query($conn, $sql2);
                
                    if ($res2 && mysqli_num_rows($res2) > 0) {
                        $row2 = mysqli_fetch_assoc($res2);
                        $category_title = $row2['title'];
                    } else {
                        $category_title = "Unknown Category"; // Or handle this case appropriately
                    }


                    ?>
                    <tr>
                        <td><?php echo $sn++; ?>. </td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $description; ?></td>
                        <td><?php echo $price; ?></td>
                        <td>
                            <?php 
                            if ($image_name != "") {
                                ?>
                                <img src="<?php echo SITEURL; ?>image/food/<?php echo $image_name; ?>" width="100px">
                                <?php
                            } else {
                                echo "<div class='error'>Image not Added.</div>";
                            }
                            ?>
                        </td>
                        <td><?php echo $category_title; ?></td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-primary">Update Food</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Delete Food</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                // Food not Added in Database
                echo "<tr> <td colspan='9' class='error'> Food not Added Yet. </td> </tr>";
            }
            ?>

        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
