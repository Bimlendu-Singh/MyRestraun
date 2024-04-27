<!-- code to include menu section -->
<?php include('partials/menu.php') ?>


<!-- Menu content Section Starts Here  -->
<div class="main-content">
    <div class="wrapper overflow">
        <h2>Dashboard</h2>

           <br>
           <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            <br>

        <div class="col-4 text-allign-center">

            <h1>5</h1>
            <br>
            Categories

        </div>

        <div class="col-4 text-allign-center">

            <h1>5</h1>
            <br>
            Categories

        </div>

        <div class="col-4 text-allign-center">

            <h1>5</h1>
            <br>
            Categories

        </div>

        <div class="col-4 text-allign-center">

            <h1>5</h1>
            <br>
            Categories

        </div>
    </div>
</div>
<!-- Menu content Section Ends Here  -->

<!-- code to include footer section -->
<?php include('partials/footer.php') ?>