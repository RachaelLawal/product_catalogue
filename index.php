<?php 
include 'header.php';
include 'db.php';
?>

<section class="products">
    <h2>Featured Products</h2>

    <div class="product-list">
        <?php
        // Query for the database to select all rows from the 'products' table
        $stmt = $db->query("SELECT * FROM products");

         // Query the database to select all rows from the 'products' table
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="product">';
             //Used htmlspecialchars() to ensure that special characters are converted to HTML entities
            echo '<img src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
            echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p>Description: ' . htmlspecialchars($row['description']) . '</p>';
            echo '<p>Price: $' . number_format($row['price'], 2) . '</p>';
            
             // Check if the user is logged in before showing edit and delete options
            if (isLoggedIn()) {
                //link to edit the product
                echo '<a href="update_product.php?id=' . $row['id'] . '">Edit</a> | ';
                //link to delete the product
                echo '<a href="delete_product.php?id=' . $row['id'] . '">Delete</a>';
            }
            echo '</div>';
        }
        ?>
    </div>
</section>

<?php include 'footer.php'; ?>




