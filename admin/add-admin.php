<?php include('partials/menu.php') ?>

<!-- Main content Section Starts Here  -->
<div class="main-content">
    <div class="wrapper overflow">
        <h2>Add Admin</h2>

        <br>

        <form action="" method"POST"">

            <table class="tbl-width-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

               <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan ="2"> 
                        <input type="submit" name="submit" value="Add Admin" class="submit">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>
<!-- Main content Section Ends Here  -->


<?php include('partials/footer.php') ?>
