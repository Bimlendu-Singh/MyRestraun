<?php
ob_start();
include('partials-front/menu.php');
?>

<?php 
// Check whether food id is set or not
if(isset($_GET['food_id']))
{
    // Get the Food id and details of the selected food
    $food_id = $_GET['food_id'];

    // Get the Details of the Selected Food
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    // Execute the Query
    $res = mysqli_query($conn, $sql);
    // Count the rows
    $count = mysqli_num_rows($res);
    // Check whether the data is available or not
    if($count==1)
    {
        // We Have Data
        // Get the Data from Database
        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    }
    else
    {
        // Food not Available
        // Redirect to Home Page
        header('location:'.SITEURL);
        ob_end_flush();
    }
}
else
{
    // Redirect to homepage
    header('location:'.SITEURL);
    ob_end_flush();
}
?>

<!-- Food Search Section Starts Here -->
<section class="food-search">
    <div class="container">
        <h2 class="text-allign-center text-white">
            Fill this form to confirm your order.
        </h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend class="text-yellow">Selected Food</legend>

                <div class="food-menu-img">
                    <?php 
                        // Check whether the image is available or not
                        if($image_name == "")
                        {
                            // Image not Available
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else
                        {
                            // Image is Available
                            ?>
                            <img src="<?php echo SITEURL; ?>image/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                            <?php
                        }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3 class="text-yellow"><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">

                    <p class="food-price text-yellowgreen">Rs<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label text-yellowgreen">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                </div>
            </fieldset>

            <fieldset>
                <legend class="text-yellowgreen">Delivery Details</legend>
                <div class="order-label text-yellow">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Bheem Singh" class="input-responsive" required>

                <div class="order-label text-yellow">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label text-yellow">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@bheemsingh.com" class="input-responsive" required>

                <div class="order-label text-yellow">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input
                    style="margin: auto 42%; margin-bottom: 3%"
                    type="submit"
                    name="submit"
                    value="Confirm Order"
                    class="btn btn-primary"
                />
            </fieldset>
        </form>

        <?php 
            // Check whether submit button is clicked or not
            if(isset($_POST['submit']))
            {
                // Get all the details from the form
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty; // total = price x qty 

                $order_date = date("Y-m-d h:i:sa"); //Order Date

                $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                // Save the Order in Database
                $sql2 = "INSERT INTO tbl_order SET 
                    food = '$food',
                    price = $price,
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                ";

                // Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                // Check whether query executed successfully or not
                if($res2 == true)
                {
                    // Query Executed and Order Saved
                    $_SESSION['order'] = "<div class='success text-allign-center'>Food Ordered Successfully.</div>";
                    header('location:'.SITEURL);
                }
                else
                {
                    // Failed to Save Order
                    $_SESSION['order'] = "<div class='error text-allign-center'>Failed to Order Food.</div>";
                    header('location:'.SITEURL);
                }
                ob_end_flush();
            }
        ?>
    </div>
</section>
<!-- Food Search Section Ends Here -->

<?php include('partials-front/footer.php') ?>
