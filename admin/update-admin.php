<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Admin</h2>

        <br> <br>

        <?php

            // 1. Get the ID of selected Admin
            $id=$_GET['id'];

            // 2. Create SQL Query to
            $sql = "SELECT * FROM tbl_admin";

            //Execute the Query
            $res = "mysqli_query($conn, $sql)";

            //Check whether the query is executed or not
            if(res==true)
            {
                // Check whether the data is available or not
                $count = mysqli_num_rows($res);
                // check whether we have admin data or not
                if($count==1)
                {
                    // Get the Deatils
                    echo "Admin Available";
                }
                else{
                    // Redirect to Admin Page
                    header('location:'.SITEURL.'admin/manage-admin.php):
                }
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-width-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="">
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

