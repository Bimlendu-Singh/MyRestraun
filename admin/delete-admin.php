<?php


    // Include Constants.php file here
    include('../config/constants.php');

    // 1. Get the ID of the Admin to be Deleted
    $id = $_GET['id'];

    // 2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id = $id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed successfully or not
    if($res == true)
    {
        // Query Executed susccessfully and Admin Deleted
        // echo "Admin Deleted";

        // Create session variable to display message
        $_SESSION['delete'] = "Admin Delete Successfully";
        // Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // Failed to Delete the Data
        // echo "Failed to Delete the Admin";

        $_SESSION['delete'] = "Failed to Delete Admin, Try Again Later";
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
    // 3. Redirect to Manage Admin page with message (sucess/error)



?>