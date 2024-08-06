<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <?php
        // Check whether the ID is set or not
        if (isset($_GET['id'])) {
            // Get the ID and all other details
            $id = $_GET['id'];

            // Create SQL Query to get all other details
            $sql = "SELECT * FROM tbl_food WHERE id=$id";
            // Execute the Query
            $res = mysqli_query($conn, $sql);

            // Count the Rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                // Get all the data
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $current_image = $row['image_name'];
                $current_category = $row['category_id'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                // Redirect to manage-food with session message
                $_SESSION['no-food-found'] = "<div class='error'>Food not Found.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        } else {
            // Redirect to Manage Food
            header('location:' . SITEURL . 'admin/manage-food.php');
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                        if ($current_image != "") {
                            ?>
                            <img src="<?php echo SITEURL; ?>image/food/<?php echo $current_image; ?>" width="100px">
                            <?php
                        } else {
                            echo "<div class='error'>Image not Added.</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            // Create PHP Code to display categories from Database
                            // 1. Create SQL to get all active categories from database
                            $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";
                            // Executing query
                            $res2 = mysqli_query($conn, $sql2);
                            // Count rows to check whether we have categories or not
                            $count2 = mysqli_num_rows($res2);

                            // If count is greater than zero, we have categories else we don't have categories
                            if ($count2 > 0) {
                                // We have categories
                                while ($row2 = mysqli_fetch_assoc($res2)) {
                                    // Get the details of categories
                                    $category_id = $row2['id'];
                                    $category_title = $row2['title'];
                                    ?>
                                    <option value="<?php echo $category_id; ?>" <?php if ($current_category == $category_id) {
                                        echo "selected";
                                    } ?>><?php echo $category_title; ?></option>
                                    <?php
                                }
                            } else {
                                // We do not have categories
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") {
                            echo "checked";
                        } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") {
                            echo "checked";
                        } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {
            // Get all the details from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // Update the new image if selected
            // Check whether the image is selected or not
            if (isset($_FILES['image']['name'])) {
                // Get the image details
                $image_name = $_FILES['image']['name'];

                // Check whether the image is available or not
                if ($image_name != "") {
                    // Image available
                    // A. Uploading new image

                    // Auto Rename our Image
                    $temp = explode('.', $image_name);
                    $ext = end($temp);

                    $image_name = "Food_Name_" . rand(000, 999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../image/food/" . $image_name;

                    // Finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image uploaded or not
                    if ($upload == false) {
                        // Failed to upload the image
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload New Image.</div>";
                        header('location:' . SITEURL . 'admin/manage-food.php');
                        die();
                    }

                    // B. Remove current image if available
                    if ($current_image != "") {
                        $remove_path = "../image/food/" . $current_image;
                        $remove = unlink($remove_path);

                        // Check whether the image is removed or not
                        if ($remove == false) {
                            // Failed to remove current image
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove Current Image.</div>";
                            header('location:' . SITEURL . 'admin/manage-food.php');
                            die();
                        }
                    }

                } else {
                    $image_name = $current_image; // Default image when image is not selected
                }

            } else {
                $image_name = $current_image; // Default image when button is not clicked
            }

            // Update the Database
            $sql3 = "UPDATE tbl_food SET 
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
                WHERE id=$id
            ";

            // Execute the SQL Query
            $res3 = mysqli_query($conn, $sql3);

            // Check whether the query executed or not
            if ($res3 == true) {
                // Query Executed and Food Updated
                $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                // Failed to update food
                $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }

        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
