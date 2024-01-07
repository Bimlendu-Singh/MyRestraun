<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Admin</h2>

        <br> <br>

        <form action="" method="POST">

            <table class="tbl-width-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="">
                    </td>
                </tr>

                <tr>
                    <td colspan ="2"> 
                        <input type="submit" name="submit" value="Update Admin" class="submit" >
                    </td>
                </tr>
            </table>

        </form>
        
    </div>
</div>

<?php include('partials/footer.php') ?>

