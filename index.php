<?php
session_start();
$conn = new mysqli("DB_HOST", "DB_USER", "DB_PASS", "DB_NAME");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T K - Computers</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="container">
            <div class="logo">T K - Computers</div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#products">Products</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="cart.php">Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a></li>
            </ul>
        </div>
    </nav>
	
	

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <h1>Discover Amazing Deals at T.K Computers</h1>
            <p>Shop the latest tech products with ease and style</p>
            <a href="#products" class="btn">Start Shopping</a>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="products">
        <div class="container">
            <h2>Our Products</h2>
            <div class="product-grid">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="product-item">
                        <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" class="product-image">
                        <h3><?php echo $row['name']; ?></h3>
                        <p><?php echo $row['description']; ?></p>
                        <p class="price">$<?php echo number_format($row['price'], 2); ?></p>
                        <form action="add_to_cart.php" method="POST" class="add-to-cart-form">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <input type="number" name="quantity" value="1" min="1">
                            <button type="submit" class="btn">Add to Cart</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="container">
            <h2>Why Shop With Us?</h2>
            <div class="feature-grid">
                <div class="feature-item">
                    <i class="fas fa-shopping-cart fa-2x feature-icon"></i>
                    <h3>Easy Shopping</h3>
                    <p>Add products to your cart with a single click.</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-lock fa-2x feature-icon"></i>
                    <h3>Secure Checkout</h3>
                    <p>Simulated checkout process for a seamless experience.</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-bolt fa-2x feature-icon"></i>
                    <h3>Fast Updates</h3>
                    <p>Update your cart instantly without refreshing the page.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="container">
            <p>© 2025 All rights reserved by T.K Computers..</p>
            <ul class="footer-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#products">Products</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </div>
    </footer>

    <!-- Success Message Container -->
    <div id="success-message" class="success-message">Item added to cart!</div>

    <script src="js/script.js"></script>
</body>
</html>

<?php $conn->close(); ?>