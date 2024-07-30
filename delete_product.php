<?php
include 'header.php';
include 'db.php';

// Check if the request method is POST,i.e if form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // Retrieve the submitted product ID
    $product_id = $_POST['product_id'];

    // Fetch image path and delete file
    //SQL statement to select the 'image' column from the 'products' table where the 'id' matches the given product ID
    $stmt_img = $db->prepare("SELECT image FROM products WHERE id=?");
    $stmt_img->execute([$product_id]); //executes prepared statement
    $image_path = $stmt_img->fetchColumn();

    // If an image path is found, delete the image file from the server
    if ($image_path) {
        unlink($image_path); 
    }

    // Prepare an SQL statement to delete the product from the database
    $stmt = $db->prepare("DELETE FROM products WHERE id=?");
    // Execute the statement with the product ID
    $stmt->execute([$product_id]);

    // Set a success message in the session and redirect
    $_SESSION['message'] = 'Product deleted successfully!';
    header("Location: products.php");
    exit();  // Terminate the script to ensure the redirect occurs
}

// Fetch the product details using the product ID from the query string
// $_GET['id'] gets the 'id' parameter value from the URL, which specifies the product to be fetched
$product_id = $_GET['id'];

//select all columns from the procut table where the id matches the given product id
$stmt = $db->prepare("SELECT * FROM products WHERE id=?");

// Execute the prepared statement, passing the retrieved product ID as the parameter
$stmt->execute([$product_id]);

//Fetching the result as associative array using column names as keys
$product = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<section class="delete-product">
    <h2>Delete Product</h2>
    <?php if ($product): ?>
        <!-- Display a confirmation message with the product name -->
        <p>Are you sure you want to delete the product: <?php echo htmlspecialchars($product['name']); ?>?</p>
        <form action="delete_product.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
            <button type="submit">Confirm Delete</button>
        </form>
    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>
</section>

<?php include 'footer.php'; ?>
