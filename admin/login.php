<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login- MyRestraun System</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>
    
        <div class="login">
            <h1 class="text-allign-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            <br><br>

            <!-- Login form starts here -->
            <form action="" method="POST" class="text-allign-center">

                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>

            </form>
            <!-- Login form starts here -->

            <p class="text-allign-center">Created By - <a href="#"></a>Bimlendu Singh</p>
        </div>

</body>
</html>

<?php

    // Check whether the sumbit button is clicked or not
    if(isset($_POST['submit']))
    {

        // Process for Login
        // 1. Get the data from Login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // 2. SQL to check whether the user with username or password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password = '$password'";

        // 3. Execute the Query
        $res = mysqli_query($conn, $sql);

        // 4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            // User available and Login success
            $_SESSION['login'] = "<div class = 'success'> Login Successful.</div> ";
            $_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unset it

            // Redirect to Home page/dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {

            // User not available and Login Fail
            $_SESSION['login'] = "<div class = 'errorlogin text-allign-center'> Username or Password did not match.</div> ";
            // Redirect to Home page/dashboard
            header('location:'.SITEURL.'admin/login.php');

        }

    }

?>