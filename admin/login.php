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
    
        <div class="login text-allign-center">
            <h1>Login</h1>
            <br><br>

            <!-- Login form starts here -->
            <form action="" method="POST">

                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>

            </form>
            <!-- Login form starts here -->

            <p>Created By - <a href="#"></a>Bimlendu Singh</p>
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
        $password = $_POST['password'];

        // 2. SQL to check whether the user with username or password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password = '$password'";

        // 3. Execute the Query
        $res = mysqli_query($conn, $sql);

    }

?>