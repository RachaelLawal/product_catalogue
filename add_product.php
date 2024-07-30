<?php
// Include the header.php file, which might contain common header elements for the page
include 'header.php';
// Include the db.php file, which likely contains the database connection code
include 'db.php'; 

// Check if the request method is POST, indicating that the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    // Retrieve the submitted form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle image upload
    $image_path = ''; // Placeholder for image path

    // Check if there is no error in the uploaded file
    if ($_FILES['image']['error'] === 0) {
        $upload_dir = 'uploads/'; // Directory for uploaded images
        $image_name = uniqid() . '_' . $_FILES['image']['name'];  // Create a unique name for the uploaded image
        $target = $upload_dir . $image_name;   // Set the target path for the uploaded image
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            // If the file was successfully moved, set the image path
            $image_path = $target;
        }
    }

    // SQL statement to insert the new product into the database
    $stmt = $db->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $image_path]); // Execute the statement with the form data

    // Redirect and show success message
    header("Location:index.php");
    exit(); //Terminate the script to ensure the redirect occurs
}
?>

<!--form where the user fills in details-->
<section class="add-product">
    <h2>Add Product</h2>
    <form action="add_product.php" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label> <!--Holds product name-->
        <input type="text" id="name" name="name" required>

        <label for="description">Description:</label> <!--Holds product description-->
        <textarea id="description" name="description" required></textarea>

        <label for="price">Price:</label> <!--Holds product price-->
        <input type="number" id="price" name="price" step="0.01" min="0" required>

        <label for="image">Image:</label> <!--Holds product image-->
        <input type="file" id="image" name="image" accept="image/*" required>

        <button type="submit">Add Product</button> <!--submit button that later redirects to the home page-->
    </form>
</section>

<?php include 'footer.php'; ?>
