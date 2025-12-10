<?php
session_start();

// Initialize cart if not present
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle clear cart
if (isset($_GET['action']) && $_GET['action'] === 'clear') {
    $_SESSION['cart'] = [];
    header('Location: cart.php');
    exit;
}

// Handle remove item
if (isset($_GET['action']) && $_GET['action'] === 'remove' && !empty($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
    header('Location: cart.php');
    exit;
}

// Handle add to cart via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? trim($_POST['id']) : '';
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0.0;

    if ($id !== '') {
        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'qty' => 1,
            ];
        } else {
            $_SESSION['cart'][$id]['qty'] += 1;
        }
    }

    // After adding, redirect to cart to show updated contents (avoids resubmission)
    header('Location: cart.php');
    exit;
}

// Simple cart display
$total = 0.0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['qty'];
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shopping Cart</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .cart-table { width: 100%; border-collapse: collapse; margin-top: 16px; }
    .cart-table th, .cart-table td { padding: 8px 12px; border: 1px solid #eee; text-align: left; }
    .actions { margin-top: 10px; }
    .actions a { margin-right: 8px; }
  </style>
</head>
<body>
  <header>Big City Gadget — Cart</header>
  <main class="main">
    <h1>Your Cart</h1>

    <?php if (empty($_SESSION['cart'])): ?>
      <p>Your cart is empty — <a href="gadgetstore.html">continue shopping</a>.</p>
    <?php else: ?>
      <table class="cart-table">
        <thead>
          <tr><th>Item</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th></th></tr>
        </thead>
        <tbody>
        <?php foreach ($_SESSION['cart'] as $item): ?>
          <tr>
            <td><?php echo htmlspecialchars($item['name']); ?></td>
            <td><span class="price">₦<?php echo number_format($item['price'], 2); ?></span></td>
            <td><?php echo intval($item['qty']); ?></td>
            <td><span class="price">₦<?php echo number_format($item['price'] * $item['qty'], 2); ?></span></td>
            <td><a href="cart.php?action=remove&id=<?php echo urlencode($item['id']); ?>">Remove</a></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr><th colspan="3">Total</th><th><span class="price">₦<?php echo number_format($total, 2); ?></span></th><th></th></tr>
        </tfoot>
      </table>

      <div class="actions">
        <a href="gadgetstore.html" class="continue">Continue shopping</a>
        <a href="cart.php?action=clear">Clear cart</a>
        <a href="checkout.html">Proceed to checkout</a>
      </div>
    <?php endif; ?>
  </main>

  <footer>
    <p>&copy; 2025 Big City Gadget. All rights reserved.</p>
  </footer>
</body>
</html>
