<?php

    // Include constants.php for SITEURL
    include('../config/constants.php');

    // 1.Destroy the Session
    session_destroy();

    // 2.Redirect to Login Page
    header('location:'.SITEURL.'admin/login.php');

?>