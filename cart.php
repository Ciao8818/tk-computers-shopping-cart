<?php
session_start();
$conn = new mysqli("DB_HOST", "DB_USER", "DB_PASS", "DB_NAME");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T K - Shopping Cart</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="container">
            <div class="logo">T K - Computers</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php#products">Products</a></li>
                <li><a href="index.php#features">Features</a></li>
                <li><a href="cart.php">Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a></li>
            </ul>
        </div>
    </nav>

    <!-- Cart Section -->
    <section class="cart">
        <div class="container">
            <h2>Your Cart</h2>
            <table>
                <tr><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th><th>Action</th></tr>
                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $id => $quantity): ?>
                        <?php
                        $result = $conn->query("SELECT * FROM products WHERE id = $id");
                        $product = $result->fetch_assoc();
                        $subtotal = $product['price'] * $quantity;
                        $total += $subtotal;
                        ?>
                        <tr>
                            <td><?php echo $product['name']; ?></td>
                            <td>$<?php echo number_format($product['price'], 2); ?></td>
                            <td>
                                <form action="update_cart.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                    <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1">
                                    <button type="submit" class="btn">Update</button>
                                </form>
                            </td>
                            <td>$<?php echo number_format($subtotal, 2); ?></td>
                            <td><a href="update_cart.php?remove=<?php echo $id; ?>" class="btn remove">Remove</a></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr><td colspan="3">Total</td><td>$<?php echo number_format($total, 2); ?></td><td></td></tr>
                <?php else: ?>
                    <tr><td colspan="5">Your cart is empty.</td></tr>
                <?php endif; ?>
            </table>
            <?php if (!empty($_SESSION['cart'])): ?>
                <a href="#" onclick="alert('Payment not implemented.')" class="btn checkout">Proceed to Checkout</a>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>© 2025 All rights reserved by T.K Computers..</p>
            <ul class="footer-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php#products">Products</a></li>
                <li><a href="index.php#features">Features</a></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>

<?php $conn->close(); ?>