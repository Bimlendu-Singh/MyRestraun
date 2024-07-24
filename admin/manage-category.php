<?php include('partials/menu.php') ?>

<!-- Main content Section Starts Here  -->
<div class="main-content">
    <div class="wrapper overflow">
        <h2>Manage Category</h2>
     
        <br>

        <!-- Button to Add Admin -->
        <a class="button" href="">Add Category</a>
        <br>
        <br>
     
    <table class="tbl-width-full">
        <tr>
            <th>S.N.</th>
            <th>Category</th>
            <th>Food Name</th>
            <th>Actions</th>
        </tr>

        <tr>
            <td>1.</td>
            <td>Italian</td>
            <td>Pasta</td>
            <td>
            <a class="btn-primary" href="">Update Category</a>
            <a class="btn-secondary" href="">Delete Category</a>
            </td>
        </tr>

        <tr>
            <td>2.</td>
            <td>Chinese</td>
            <td>Hakka Noodles</td>
            <td>
            <a class="btn-primary" href="">Update Category</a>
            <a class="btn-secondary" href="">Delete Category</a>
            </td>
        </tr>
        
        <tr>
            <td>3.</td>
            <td>Indian</td>
            <td>Dosa</td>
            <td>
            <a class="btn-primary" href="">Update Category</a>
            <a class="btn-secondary" href="">Delete Category</a>
            </td>
        </tr>
    </table>
    </div>
</div>
<!-- Main content Section Ends Here  -->

<?php include('partials/footer.php') ?>
