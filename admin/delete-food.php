<?php
include('../config/constants.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) {
    // Process to delete
    // 1. Get ID and Image Name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // 2. Remove the Image if Available
    if ($image_name != "") {
        // Remove Image
        $path = "../image/food/" . $image_name;
        $remove = unlink($path);

        // If failed to remove image then add an error message and stop the process
        if ($remove == false) {
            $_SESSION['remove'] = "<div class='error'>Failed to Remove Food Image.</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
            die();
        }
    }

    // 3. Delete Food from Database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed or not and set the session message respectively
    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else {
    // Redirect to Manage Food Page
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>
