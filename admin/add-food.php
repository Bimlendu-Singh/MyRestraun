<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
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

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
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
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            // Executing query
                            $res = mysqli_query($conn, $sql);
                            // Count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);

                            // If count is greater than zero, we have categories else we don't have categories
                            if ($count > 0) {
                                // We have categories
                                while ($row = mysqli_fetch_assoc($res)) {
                                    // Get the details of categories
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {
            // Get the Data from Form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
            $active = isset($_POST['active']) ? $_POST['active'] : "No";

            // Check whether the image is selected or not and set the value for image name accordingly
            if (isset($_FILES['image']['name'])) {
                // Upload the Image
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {
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
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        header('location:' . SITEURL . 'admin/add-food.php');
                        die();
                    }
                }
            } else {
                $image_name = ""; // Setting default value as blank
            }

            // Insert into Database
            $sql2 = "INSERT INTO tbl_food SET 
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
            ";

            // Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            // Check whether data inserted or not
            if ($res2 == true) {
                // Data inserted successfully
                $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                // Failed to insert data
                $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                header('location:' . SITEURL . 'admin/add-food.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
