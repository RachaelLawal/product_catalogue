<?php
include 'header.php';
include 'db.php';

// Check for messages
$message = ''; // Initialize an empty message string
if (isset($_SESSION['message'])) { // Check if there's a message stored in the session
    $message = $_SESSION['message']; // Assign the session message to the $message variable

    unset($_SESSION['message']); // Clear the message after displaying it
}
?>

<section class="products">
    <h2>Featured Products</h2>

    <?php if ($message): ?> <!--checks if the variable $message is not empty.-->
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <div class="product-list">
        <?php
        $stmt = $db->query("SELECT * FROM products");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Fetch each product as an associative array
            echo '<div class="product">';
            echo '<img src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
            // Display the product image with HTML escaping
            echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
            // Display the product name with HTML escaping
            echo '<p>Description: ' . htmlspecialchars($row['description']) . '</p>';
            // Display the product description with HTML escaping
            echo '<p>Price: $' . number_format($row['price'], 2) . '</p>'; // Display the product price formatted to 2 decimal places
            if (isLoggedIn()) {
                echo '<a href="update_product.php?id=' . $row['id'] . '">Edit</a> | ';
                echo '<a href="delete_product.php?id=' . $row['id'] . '">Delete</a>';
            }
            echo '</div>';
        }
        ?>
    </div>
</section>

<?php include 'footer.php'; ?>
