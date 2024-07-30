<?php
include 'header.php';
include 'db.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle registration logic
    $username = $_POST['username'];
     // Hash the password using the default algorithm (currently bcrypt)
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //SQL statement to insert the new user into the 'users' table
    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    // Execute the SQL statement with the username and hashed password as parameters
    $stmt->execute([$username, $password]);

    // Redirect or show success message
    header("Location: login.php");
    exit();
}
?>

<section class="register">
    <h2>Register</h2>
    <form action="register.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Register</button>
    </form>
</section>

<?php include 'footer.php'; ?>
