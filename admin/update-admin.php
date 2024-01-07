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
                        <input type="submit" name="submit" value="Update Admin" class="submit" >
                    </td>
                </tr>
            </table>

        </form>
        
    </div>
</div>

<?php include('partials/footer.php') ?>

