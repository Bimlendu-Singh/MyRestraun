<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us - Bheem's Restaurant</title>
    <link rel="stylesheet" href="css/contact.css" />
    <link rel="stylesheet" href="css/style.css">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="image/apple-touch-icon.png">

    <!-- Link of font family included -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Foldit:wght@300&family=Roboto&display=swap" rel="stylesheet">
</head>

<body>

    <!-- Navbar Section Starts Here -->
    <section class="Navbar">
        <div class="container navbar-container">
            <div class="logo">
                <img class="responsive-img" src="image/logo/logo 15.png" alt="Restaurant Logo">
            </div>
            
            <div class="menu text-allign-center">
                <ul>
                    <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>foods.php">Foods</a></li>
                    <li><a href="<?php echo SITEURL; ?>categories.php">Categories</a></li>
                    <li><a href="<?php echo SITEURL; ?>about.php">About</a></li>
                    <li><a href="<?php echo SITEURL; ?>contact.php">Contact</a></li>                    
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
    <br>

    <div class="container">
        <h1 class="text-allign-center" style="color: rgb(255, 106, 0)">Contact Us</h1>
        <br />

        <div class="wrapper">
            <!-- COMPANY INFORMATION -->
            <div class="company-info">
                <h3>My Restraun</h3>

                <ul>
                    <li><i class="fa fa-road"></i> Satsang Ashram</li>
                    <li><i class="fa fa-phone"></i> +91 9006337628</li>
                    <li><i class="fa fa-envelope"></i> satsang@myrestraun.com</li>
                </ul>
            </div>
            <!-- End .company-info -->

            <!-- CONTACT FORM -->
            <div class="contact">
                <!-- <h3>E-mail Us</h3> -->

                <form id="contact-form" action="" method="POST">
                    <p>
                        <label>Name</label>
                        <input type="text" name="name" id="name" required />
                    </p>

                    <p>
                        <label>Profession</label>
                        <input type="text" name="profession" id="profession" />
                    </p>

                    <p>
                        <label>E-mail Address</label>
                        <input type="email" name="email" id="email" required />
                    </p>

                    <p>
                        <label>Phone Number</label>
                        <input type="text" name="phone" id="phone" />
                    </p>

                    <p class="full">
                        <label>Message</label>
                        <textarea name="message" rows="5" id="message"></textarea>
                    </p>

                    <p class="full">
                        <button type="submit" name="submit">Submit</button>
                    </p>
                </form>
                <!-- End #contact-form -->
            </div>
            <!-- End .contact -->
        </div>
        <!-- End .wrapper -->
    </div>
    <!-- End .container -->
    <br>

    <!-- Social Media Section Starts Here -->
    <section class="social text-allign-center">
        <div class="">
            <ul>
                <li><a href="http://www.facebook.com"><img src="./image/fbicon.png" alt="Facebook"></a></li>
                <li><a href="http://www.instagram.com"><img src="./image/instaicon.png" alt="Instagram"></a></li>
                <li><a href="http://www.twitter.com"><img src="./image/twittericon.gif" alt="Twitter"></a></li>
            </ul>
        </div>
    </section>
    <!-- Social Media Section Ends Here -->
    <br>

    <!-- Footer Section Starts Here -->
    <section class="Footer">
        <div class=" text-allign-center">
            <p>All rights reserved. Designed By <a href="">Bheem Singh And Amreen Wafa</a></p>
        </div>
    </section>
    <br>
    <!-- Footer Section Ends Here -->

</body>
</html>

<?php 

if(isset($_POST['submit']))
{
    // Get form data
    $name = $_POST['name'];
    $profession = $_POST['profession'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Prepare SQL query
    $sql = "INSERT INTO tbl_contact (cn_name, cn_proffesion, cn_email, cn_phone, cn_message) 
            VALUES (?, ?, ?, ?, ?)";

    // Prepare statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssss", $name, $profession, $email, $phone, $message);

    // Execute statement
    if(mysqli_stmt_execute($stmt))
    {
        echo "<script>alert('Your message has been sent successfully!');</script>";
    }
    else
    {
        echo "<script>alert('Failed to send your message. Please try again later.');</script>";
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);

?>
