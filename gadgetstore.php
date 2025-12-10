<?php session_start();
$count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) $count += $item['qty'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Gadget Store - Catalog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>Big City Gadget</header>

    <nav>
        <a href="index.html">Home</a>
        <a href="gadgetstore.php">Gadget Store</a>
        <a href="about.html">About Us</a>
        <a href="contact.html">Contact</a>
    </nav>

    <!-- Shopping cart indicator -->
    <div class="shopping-cart">
      <a id="cart-btn" aria-label="Shopping cart" href="cart.php">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="feather feather-shopping-cart" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
          <circle cx="9" cy="21" r="1"></circle>
          <circle cx="20" cy="21" r="1"></circle>
          <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
        </svg>
        <span id="item-count"><?php echo intval($count); ?></span>
      </a>
    </div>

    <main class="main">
        <h1>Our Gadget Collection</h1>
        <p>Explore our wide range of gadgets designed to make life easier, smarter, and more exciting.</p>

        <div class="products-grid">
            <article class="product" data-id="x200" data-name="Smartphone X200" data-price="718">
                <img src="images/smartphone.jpg" alt="Smartphone X200">
                <h3>Smartphone X200</h3>
                <p>The Smartphone X200 features a stunning display, powerful processor, and an advanced camera system.</p>
                <p><strong>Price: <span class="price">₦718</span></strong></p>
                <form class="buy-form" action="cart.php" method="post">
                    <input type="hidden" name="id" value="x200">
                    <input type="hidden" name="name" value="Smartphone X200">
                    <input type="hidden" name="price" value="718">
                    <input type="submit" value="Add to cart">
                </form>
            </article>

            <article class="product" data-id="earbuds-pro" data-name="Wireless Earbuds Pro" data-price="129">
                <img src="images/earbuds.jpg" alt="Wireless Earbuds Pro">
                <h3>Wireless Earbuds Pro</h3>
                <p>Experience true wireless freedom with superior sound quality and noise cancellation.</p>
                <p><strong>Price: <span class="price">₦129</span></strong></p>
                <form class="buy-form" action="cart.php" method="post">
                    <input type="hidden" name="id" value="earbuds-pro">
                    <input type="hidden" name="name" value="Wireless Earbuds Pro">
                    <input type="hidden" name="price" value="129">
                    <input type="submit" value="Add to cart">
                </form>
            </article>

            <article class="product" data-id="smartwatch-5" data-name="Smartwatch Series 5" data-price="249">
                <img src="images/smartwatch.jpg" alt="Smartwatch Series 5">
                <h3>Smartwatch Series 5</h3>
                <p>Stay connected and track your fitness with the latest Smartwatch Series 5.</p>
                <p><strong>Price: <span class="price">₦249</span></strong></p>
                <form class="buy-form" action="cart.php" method="post">
                    <input type="hidden" name="id" value="smartwatch-5">
                    <input type="hidden" name="name" value="Smartwatch Series 5">
                    <input type="hidden" name="price" value="249">
                    <input type="submit" value="Add to cart">
                </form>
            </article>

            <article class="product" data-id="speaker-max" data-name="Bluetooth Speaker Max" data-price="99">
                <img src="images/speaker.jpg" alt="Bluetooth Speaker Max">
                <h3>Bluetooth Speaker Max</h3>
                <p>Enjoy high-quality sound on the go with the portable Bluetooth Speaker Max.</p>
                <p><strong>Price: <span class="price">₦99</span></strong></p>
                <form class="buy-form" action="cart.php" method="post">
                    <input type="hidden" name="id" value="speaker-max">
                    <input type="hidden" name="name" value="Bluetooth Speaker Max">
                    <input type="hidden" name="price" value="99">
                    <input type="submit" value="Add to cart">
                </form>
            </article>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Big City Gadget. All rights reserved.</p>
    </footer>
</body>
</html>
