<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/contact.css" />

    <title>Contact Us</title>
  </head>
  <body>
    <!-- Navbar Section Starts Here -->
    <section class="Navbar">
      <div class="container navbar-container">
        <div class="logo">
          <img
            class="responsive-img"
            src="image/logo/logo 15.png"
            alt="Restaurant Logo"
          />
        </div>

        <div class="menu text-allign-center">
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="foods.html">Foods</a></li>
            <li><a href="categories.html">Categories</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </div>

        <div class="clearfix"></div>
      </div>
    </section>
    <!-- Navbar Section Ends Here -->

    <div class="container">
      <h1 class="text-allign-center" style="color: rgb(255, 106, 0)">
        Contact Us
      </h1>
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
              <label>Proffesion</label>
              <input type="text" name="company" id="company" />
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
              <button type="submit">Submit</button>
            </p>
          </form>
          <!-- End #contact-form -->
        </div>
        <!-- End .contact -->
      </div>
      <!-- End .wrapper -->
    </div>
    <!-- End .container -->

    <!-- Footer Section Starts Here -->
    <section class="Footer">
      <div class="container text-allign-center">
        <p>All rights reserved. Designed By <a href="">Bheem Singh</a></p>
      </div>
    </section>
    <!-- Footer Section Ends Here -->
  </body>
</html>


<?php 

      $localhost = "localhost";
      $username = "root"; 
      $password = ""; 
      $dbname = "restr_contact"; 
      
      //Establishing connection 
      $conn = new mysqli($localhost, $username, $password, $dbname);

      //Error check
      if ($conn->connect_error) {
      
          die("Connection failed: " . $conn->connect_error);
      
      }
      
      
          $name = $_POST['name'];
          $company = $_POST['company'];
          $email = $_POST['email'];
          $phone = $_POST['phone'];
          $message = $_POST['message'];
      
          // $sql="INSERT INTO user_db.tbl_contact (fname,lname,email,mob,comments)
          // VALUES('$fname','$lname','$email','$mob','$comments');";

          $sql = "INSERT INTO `contact` (`cn_name`, `cn_proffesion`, `cn_email`, `cn_phone`) 
          VALUES ('$name', '$company', '$phone', '$message');";
          

          // INSERT INTO `contact` (`cn_sno`, `cn_name`, `cn_proffesion`, `cn_email`, `cn_phone`, `cn_dt`) 
          // VALUES ('1', 'Bheem Singh', 'devloper', 'gh@gmail.com', '870934997', current_timestamp());
          
          $result = $conn->query($sql);
      
          if ($result == TRUE) 
          {
            echo "entered successfully";
          }
           else
          {
            echo "Error:". $sql ."<br>". $conn->error;
          }
        
?>