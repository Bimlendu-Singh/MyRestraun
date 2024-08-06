<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Category</h2>

        <br><br>

        <?php
            // 1. Get the ID of selected Category
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                // 2. Create SQL Query to get the details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                // Execute the Query
                $res = mysqli_query($conn, $sql);

                // Check whether the query is executed or not
                if ($res == true) {
                    // Check whether the data is available or not
                    $count = mysqli_num_rows($res);
                    // Check whether we have category data or not
                    if ($count == 1) {
                        // Get the Details
                        $row = mysqli_fetch_assoc($res);

                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    } else {
                        // Redirect to Manage Category Page
                        header('location:' . SITEURL . 'admin/manage-category.php');
                    }
                }
            } else {
                // Redirect to Manage Category Page
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-width-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if ($image_name != "") {
                                // Display the image
                                ?>
                                <img src="<?php echo SITEURL; ?>image/category/<?php echo $image_name; ?>" width="150px">
                                <?php
                            } else {
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") { echo "checked"; } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") { echo "checked"; } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") { echo "checked"; } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $image_name; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="submit">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            // Check whether the Submit Button is Clicked or not
            if (isset($_POST['submit'])) {
                // Get all the values from form to update
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // Updating New Image if selected
                if (isset($_FILES['image']['name'])) {
                    $image_name = $_FILES['image']['name'];

                    // Check whether the image is available or not
                    if ($image_name != "") {
                        // Image available
                        // A. Upload the New Image

                        // Auto Rename our Image
                        // Get the Extension of our image (jpg, png, gif, etc) e.g. "specialfood1.jpg"
                        // $ext = end(explode('.', $image_name));
                        $temp = explode('.', $image_name);  // Store the result of explode() in a variable
                        $ext = end($temp);    // Use end() on the array


                        // Rename the Image
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; // e.g. Food_Category_834.jpg

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../image/category/".$image_name;

                        // Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Check whether the image is uploaded or not
                        // If the image is not uploaded then we will stop the process and redirect with error message
                        if ($upload == false) {
                            // Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            // Redirect to Add Category Page
                            header('location:' . SITEURL . 'admin/manage-category.php');
                            // Stop the process
                            die();
                        }

                        // B. Remove the current image if available
                        if ($current_image != "") {
                            $remove_path = "../image/category/".$current_image;

                            $remove = unlink($remove_path);

                            // Check whether the image is removed or not
                            // If failed to remove then display message and stop the process
                            if ($remove == false) {
                                // Set the session message
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                                // Redirect to Manage Category Page
                                header('location:' . SITEURL . 'admin/manage-category.php');
                                // Stop the process
                                die();
                            }
                        }
                    } else {
                        $image_name = $current_image;
                    }
                } else {
                    $image_name = $current_image;
                }

                // Create a SQL Query to Update Category
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                // Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                // Check whether the query executed successfully or not
                if ($res2 == true) {
                    // Query Executed and Category Updated
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                    // Redirect to Manage Category Page
                    header('location:' . SITEURL . 'admin/manage-category.php');
                } else {
                    // Failed to Update Category
                    $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                    // Redirect to Manage Category Page
                    header('location:' . SITEURL . 'admin/manage-category.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
