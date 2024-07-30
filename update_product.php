<?php
include 'header.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       // Retrieve form data
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle image upload
    $image_path = ''; // Placeholder for image path
    // Check if a file was uploaded without errors
    if ($_FILES['image']['error'] === 0) {
        $upload_dir = 'uploads/'; // Directory for uploaded images
        $image_name = uniqid() . '_' . $_FILES['image']['name'];
        $target = $upload_dir . $image_name;// Full path to the target location

        // Move the uploaded file to the target location
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image_path = $target;
        }
    }

    // SQL statement to update the product details
    $stmt = $db->prepare("UPDATE products SET name=?, description=?, price=?, image=? WHERE id=?");
    // Execute the statement with the form data and image path
    $stmt->execute([$name, $description, $price, $image_path, $product_id]);

    // Set a success message in the session and redirect
    $_SESSION['message'] = 'Product updated successfully!';
    header("Location: products.php");
    exit();
}

// Fetch product details using the product ID from the query string
$product_id = $_GET['id'];// Get the product ID from the URL
$stmt = $db->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);// Fetch the product details as an associative array
?>

<section class="update-product">
    <h2>Edit Product</h2>
    <form action="update_product.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" min="0" value="<?php echo htmlspecialchars($product['price']); ?>" required>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*">

        <button type="submit">Update Product</button>
    </form>
</section>

<?php include 'footer.php'; ?>

