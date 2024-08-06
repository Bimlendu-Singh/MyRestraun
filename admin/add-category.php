<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <br><br>

        <!-- Add category form start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category form ends -->

        <?php
        // Check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {
            // Get values from form
            $title = $_POST['title'];

            // For radio input, we need to check whether the button is selected or not
            $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
            $active = isset($_POST['active']) ? $_POST['active'] : "No";

            // Check whether the image is selected or not and set the value for image name accordingly
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                // Upload the Image
                // To upload image we need image name, source path and destination path
                $image_name = $_FILES['image']['name'];

                // Auto Rename our Image
                $temp = explode('.', $image_name);
                $ext = end($temp);

                // Rename the Image
                $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../image/category/" . $image_name;

                // Finally Upload the Image
                $upload = move_uploaded_file($source_path, $destination_path);

                // Check whether the image is uploaded or not
                if ($upload == false) {
                    // Set message
                    $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                    // Redirect to Add Category Page
                    header('location:' . SITEURL . 'admin/add-category.php');
                    // Stop the process
                    die();
                }
            } else {
                // Don't upload image and set the image_name value as blank
                $image_name = "";
            }

            // Create SQL Query to Insert Category into Database
            $sql = "INSERT INTO tbl_category SET 
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
            ";

            // Execute the Query and Save in Database
            $res = mysqli_query($conn, $sql);

            // Check whether the query executed or not and data added or not
            if ($res == true) {
                // Query Executed and Category Added
                $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                // Redirect to Manage Category Page
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                // Failed to Add Category
                $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                // Redirect to Add Category Page
                header('location:' . SITEURL . 'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
