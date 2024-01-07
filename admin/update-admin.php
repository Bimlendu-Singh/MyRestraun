<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Admin</h2>

        <br> <br>

               

        </form>

        <?php

            // 1. Get the ID of selected Admin
            $id=$_GET['id'];

            // 2. Create SQL Query to
            $sql = "SELECT * FROM tbl_admin WHERE id = $id";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Check whether the query is executed or not
            if($res==true)
            {
                // Check whether the data is available or not
                $count = mysqli_num_rows($res);
                // check whether we have admin data or not
                if($count==1)
                {
                    // Get the Deatils
                    // echo "Admin Available";
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    // Redirect to Admin Page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

        

        

        <form action="" method="POST">

            <table class="tbl-width-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan ="2"> 
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="submit" >
                    </td>
                </tr>
            </table>

        </form>
        
    </div>
</div>

<?php
        
        //Check whether the Submit Button is Clicked or not
        if(isset($_POST['submit']))
        {
            //echo "Button Clicked";
            //Get all the values from form to update
            $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];


            // Create a SQL Query to Update Admin
            $sql = "UPDATE tbl_admin SET
            full_name = '$full_name',
            username = '$username'
            WHERE id = '$id'
            ";

            // $sql = "UPDATE 'tbl_admin' SET (`full_name`, `username`) 
            // VALUES ('$full_name', '$username'); WHERE id = '$id'";

            // 'UPDATE tutorials_tbl set tutorial_title = "Learning Java" where tutorial_id = 4'

            // Execute the Query
            $res = mysqli_query($conn, $sql);

            // Check whether the query executed successfully or not
            if($res==true)
            {
                //Query Executed and Admin Updated
                $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
                //Redirect to Manage Admin Page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            else
            {
                //Failed to Update Admin
                $_SESSION['update'] = "<div class='failure'>Failed to Delete Admin.</div>";
                //Redirect to Manage Admin Page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
?>

<?php include('partials/footer.php') ?>

