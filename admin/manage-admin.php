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
                $count - mysqli_num_rows($res); //Function to get all the rows in the database

                //Check the num of rows
                if($count>o)
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
                                <td>1.</td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a class="btn-primary" href="">Update Admin</a>
                                    <a class="btn-secondary" href="">Delete Admin</a>
                                </td>
                        </tr>

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