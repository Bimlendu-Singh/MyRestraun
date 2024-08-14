<?php include('partials-front/menu.php') ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
      <div class="container">
        <h2 class="text-allign-center text-white">
          Fill this form to confirm your order.
        </h2>

        <form action="#" class="order">
          <fieldset>
            <legend class="text-yellow">Selected Food</legend>

            <div class="food-menu-img">
              <img
                src="./image/menu-pizza.jpg"
                alt="Veg Hawain Pizza"
                class="img-responsive img-curve"
              />
            </div>

            <div class="food-menu-desc">
              <h3 class="text-yellow">Food Title</h3>
              <p class="food-price text-yellowgreen">$2.3</p>

              <div class="order-label text-yellowgreen">Quantity</div>
              <input
                type="number"
                name="qty"
                class="input-responsive"
                value="1"
                required
              />
            </div>
          </fieldset>

          <fieldset>
            <legend class="text-yellowgreen">Delivery Details</legend>
            <div class="order-label text-yellow">Full Name</div>
            <input
              type="text"
              name="full-name"
              placeholder="E.g. Bheem Singh"
              class="input-responsive"
              required
            />

            <div class="order-label text-yellow">Phone Number</div>
            <input
              type="tel"
              name="contact"
              placeholder="E.g. 9843xxxxxx"
              class="input-responsive"
              required
            />

            <div class="order-label text-yellow">Email</div>
            <input
              type="email"
              name="email"
              placeholder="E.g. hi@bheemsingh.com"
              class="input-responsive"
              required
            />

            <div class="order-label text-yellow">Address</div>
            <textarea
              name="address"
              rows="10"
              placeholder="E.g. Street, City, Country"
              class="input-responsive"
              required
            ></textarea>

            <input
              style="margin: auto 42%; margin-bottom: 3%"
              type="submit"
              name="submit"
              value="Confirm Order"
              class="btn btn-primary"
            />
          </fieldset>
        </form>
      </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php') ?>
