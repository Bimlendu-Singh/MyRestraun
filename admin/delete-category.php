<?php

    //Include Constants File
    include('../config/constants.php');

    //echo "Delete Page";
    // Check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // Get the value and Delete
        // echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file if available
        if($image_name != "")
        {
            // Image is available. So remove it
            $path = "../images/category/".$image_name;
            //Remove the Image
            $remove = unlink($path);

            // If failed to remove image then add an error message and stop the process
            if($remove==false)
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
    else
    {
        // Redirect to Manage Category Page
        header('location:'.SITEURL.'admin/manage-category.php');
    }


?>