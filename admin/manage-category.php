

<!-- using php repeating part // dry pattern // not repeating  same code-->

<?php include ('partials/menu.php') ?>

<div class="main">
    <div class="wrapper overflow">
        <h1>Manage category</h1>

        <br>

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

        <!-- Button to Add Admin -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

        <br>
        <br>
        <table class="tbl-width-full">
            <tr>
                <!-- table row -->

                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

            //Query to Get all CAtegories from Database
            $sql = "SELECT * FROM tbl_category";


            //Execute Query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //Create Serial Number Variable and assign value as 1
            $sn = 1;

            //Check whether we have data in database or not
            if ($count > 0) {
                //We have data in database
                //get the data and display
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                    ?>
                    <tr>
                        <!-- table data -->
                        <td><?php echo $sn++; ?>. </td>
                        <td><?php echo $title; ?></td>


                        <td>

                            <?php
                            //Chcek whether image name is available or not
                            if ($image_name != "") {
                                //Display the Image
                                ?>

                                <img src="<?php echo SITEURL; ?>image/category/<?php echo $image_name; ?>" width="100px">

                                <?php
                            } else {
                                //DIsplay the MEssage
                                echo "<div class='error'>Image not Added.</div>";
                            }
                            ?>

                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="#" class="btn-primary">Update Category</a>
                            <a href="#" class="btn-secondary">Delete Category</a>
                        </td>
                    </tr>

                    <?php

                }
            } else {
                //WE do not have data
                //We'll display the message inside table
                ?>

                <tr>
                    <td colspan="6">
                        <div class="error">No Category Added.</div>
                    </td>
                </tr>

                <?php
            }

            ?>
        </table>

    </div>
</div>

<!-- using php repeating part // dry pattern // not repeating  same code-->

<?php include ('partials/footer.php'); ?>