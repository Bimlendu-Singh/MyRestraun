<?php include('partials/menu.php') ?>


<!-- Main content Section Starts Here  -->
<div class="main-content">
    <div class="wrapper overflow">
        <br>
        <h2>Manage Admin</h2>
        <br>

        <?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];     //Displaying Session Message
                unset($_SESSION['add']);  //Removing Session Message
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];     //Displaying Deletion Message
                unset($_SESSION['delete']);  
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];     //Displaying Update Message
                unset($_SESSION['update']);  
            }

            if(isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found'];     //Displaying Password change or not  Message
                unset($_SESSION['user-not-found']);  
            }

            if(isset($_SESSION['pwd-not-match']))
            {
                echo $_SESSION['pwd-not-match'];     //Displaying Password Match or not Match
                unset($_SESSION['pwd-not-match']);  
            }

        ?>
        <br>
        <br>

        <!-- Button to Add Admin -->
        <a class="button" href="add-admin.php">Add admin</a>
        <br>
        <br>
     
    <table class="tbl-width-full">
        <tr>
            <th>S.N.</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Ations</th>
        </tr>

        <?php
            //Query to get all Admin
            $sql = "SELECT * FROM tbl_admin";
            $res = mysqli_query($conn, $sql);

            //Check whether the Query is Executed or not
            if($res==TRUE)
            {
                //Count Rows to Check whether we have data in database or not
                $count = mysqli_num_rows($res); //Function to get all the rows in the database

                $sn = 1; //Creat a variable and Assign the value

                //Check the num of rows
                if($count>0)
                {
                    //we have data in database
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        //Using while loop to get all the data from databse
                        //And while loop will run as long as we have data in database.

                        //Get individual data
                        $id = $rows['id'];
                        $full_name=$rows['full_name'];
                        $username=$rows['username'];

                        // Display the values in our Table
                        ?>

                         <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a class="btns" href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>">Change  Password</a>
                                    <a class="btn-primary" href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>">Update Admin</a>
                                    <a class="btn-secondary" href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>">Delete Admin</a>
                                </td>
                         </tr>

                    <?php    
                    }
                }
                else{
                    //We do not have Data in Database
                }
            }


        ?>


    </table>

    </div>
</div>
<!-- Main content Section Ends Here  -->


<?php include('partials/footer.php') ?>