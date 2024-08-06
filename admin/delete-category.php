<?php
// Include Constants File
include('../config/constants.php');

// Start the session
session_start();

// Check whether the id and image_name value is set or not
if(isset($_GET['id']) && isset($_GET['image_name']))
{
    // Get the value and Delete
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Remove the physical image file if available
    if($image_name != "")
    {
        // Image is available. So remove it
        $path = "../images/category/".$image_name;

        // Check if file exists before attempting to delete
        if (file_exists($path))
        {
            // Remove the Image
            $remove = unlink($path);

            // If failed to remove image then add an error message and stop the process
            if($remove == false)
            {
                // Set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove Category Image.</div>";
                // Redirect to Manage Category Page
                header('location:'.SITEURL.'admin/manage-category.php');
                // Stop the process 
                die();
            }
        }
    }

    // Delete Data from database using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM tbl_category WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execute the statement
    $res = $stmt->execute();

    // Check whether the data is deleted from database or not
    if($res)
    {
        // Set success message and redirect
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
    }
    else
    {
        // Set fail message and redirect
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
    }

    // Redirect to Manage Category Page
    header('location:'.SITEURL.'admin/manage-category.php');
}
else
{
    // Redirect to Manage Category Page
    header('location:'.SITEURL.'admin/manage-category.php');
}
?>
