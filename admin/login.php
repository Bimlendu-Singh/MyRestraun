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

        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <br><br>

        <!-- Login form starts here -->
        <form action="" method="POST" class="text-allign-center">

            Username: <br>
            <input type="text" name="username" placeholder="Enter Username" required><br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password" required><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>

        </form>
        <!-- Login form ends here -->

        <p class="text-allign-center">Created By - <a href="#">Bimlendu Singh</a></p>
    </div>

</body>
</html>

<?php

// Check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    // Process for Login
    // 1. Get the data from Login form
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hashing the password

    // 2. Prepare SQL statement to check whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username=? AND password=?";
    $stmt = mysqli_prepare($conn, $sql);

    // 3. Bind parameters to the placeholders in the prepared statement
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);

    // 4. Execute the prepared statement
    mysqli_stmt_execute($stmt);

    // 5. Get the result
    $res = mysqli_stmt_get_result($stmt);

    // 6. Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if($count == 1)
    {
        // User available and Login success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unset it

        // Redirect to Home page/dashboard
        header('location:'.SITEURL.'admin/');
    }
    else
    {
        // User not available and Login failed
        $_SESSION['login'] = "<div class='errorlogin text-allign-center'>Username or Password did not match.</div>";
        // Redirect to Login page
        header('location:'.SITEURL.'admin/login.php');
    }

    // 7. Close the prepared statement
    mysqli_stmt_close($stmt);
}

?>
