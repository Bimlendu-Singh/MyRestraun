<?php include('partials/menu.php') ?>

<!-- Main content Section Starts Here  -->
<div class="main-content">
    <div class="wrapper overflow">
        <h2>Add Admin</h2>

          <?php

            if(isset($_SESSION['add']))  //Checking whether the session is set or not
            {
                echo $_SESSION['add'];     //Display the session message if set
                unset($_SESSION['add']);  //Remove session message
            }

            ?>

        <br>

        <form action="" method="POST">

            <table class="tbl-width-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

               <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan ="2"> 
                        <input type="submit" name="submit" value="Add Admin" class="submit">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>
<!-- Main content Section Ends Here  -->


<?php include('partials/footer.php') ?>

<?php

// Process the value from form and save it in Database

//Check whether the submit button is clicked or not

if(isset($_POST['submit']))
{
    //Button clicked
    //echo "Button clicked";

    //1) Get the data from the form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $passowrd = md5($_POST['password']);  //Encrypting password usnig md5

    //2) SQL Query to save the data into database

    // $sql = "INSERT INTO `tbl_admin` VALUE 
    //     full_name='$full_name',
    //     username='$username',
    //     passowrd='$passowrd'
    // ";

    $sql = "INSERT INTO `tbl_admin` (`full_name`, `username`, `password`) VALUES ('$full_name', '$username', '$passowrd');";

    //3) Executing Query and saving the data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4) Check whether the (Query is Executed) data is inserted or not and display appropriate message

    if($res==TRUE)
    {
        //Data Inserted
        // echo "Data Inserted";

        //Create a Session Variable to Display Message
        $_SESSION['add'] = "Admin added successfully";
        //Redirect Page to Manage Admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to Insert Data
        // echo "Fail to Insert Data";

        //Create a Session Variable to Display Message
        $_SESSION['add'] = "Failed to Add Admin";
        //Redirect Page to Manage Admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }

    
}

?>
