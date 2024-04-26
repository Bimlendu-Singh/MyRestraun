<?php include('partials/menu.php') ?>

<div class= "main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
        ?>

        <form action="" method= "POST">
            <table class="tbl-width-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan ="2"> 
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="submit">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>

<?php

        //Check whether the submit button is clicked or not

        if(isset($_POST['submit']))
        {
            //Button clicked
            //echo "Button clicked";
        
            //1. Get the data from the form
            $id = $_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);
        
            //2. Check whether the user with current ID and Current Password Exist or not
            $sql = "SELECT * FROM tbl_admin WHERE id= $id AND password ='$current_password'";
        
            //Execute the Query
            $res = mysqli_query($conn, $sql);
        
            if($res==true)
            {
            
                //CHeck whether data is available or not
                $count = mysqli_num_rows($res);
            
                if($count==1)
                {
                    //User Exists and Password Can be CHanged
                    //echo "User Found";
                
                    //Check whether the new password and confirm match or not
                       if ($new_password==$confirm_password)
                        {
                           //Update the Password
                            $sql2 = "UPDATE tbl_admin SET
                              password= '$new_password'
                              WHERE id=$id
                            ";
                    
                            //Execute the Query
                             $res2 = mysqli_query($conn, $sql2);
                    
                            //CHeck whether the query executed or not
                            if($res2==true)
                              {
                                 //Display Success Message
                                //Redirect to Manage Admin Page with Success Message
                                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                                //Redirect the User
                                 header("location:".SITEURL.'admin/manage-admin.php');
                              }
                            else
                              {
                                  //Display Error Message
                                  //REdirect to Manage Admin Page with Error Message
                                  $_SESSION['change-pwd'] = "<div class='failure'>Failue to change password. </div>";
                                  //Redirect the User
                                  header("location:".SITEURL.'admin/manage-admin.php');
                              }
                        }
                        else
                        {
                            //Redirect to Manage Admin Page with Error Message
                            $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Match. </div>";
                            //Redirect the User
                            header("location:".SITEURL.'admin/manage-admin.php');
                        }
                }    
                else
                {
                    //User Does not Exist Set Message and Redirect
                    $_SESSION['user-not-found'] = "<div class='failure'>User Not Found. </div>";
                    //Redirect the User
                    header("location:".SITEURL.'admin/manage-admin.php');
                
                }
            }
        

        }
   
?>


<?php include('partials/footer.php') ?>
