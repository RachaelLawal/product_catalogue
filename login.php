<?php
include 'header.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle login logic

    
    // Get the username and password from the submitted form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    //SQL statement to select the user with the given username
    $stmt = $db->prepare("SELECT * FROM users WHERE username=?");
    
    //Execute the prepared statement with the provided username
    $stmt->execute([$username]);

    // Fetch the user data as an associative array
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify the password entered by the user with the hashed password stored in the database
    if ($user && password_verify($password, $user['password'])) {
         // Password is correct, start a session and store the user's ID in the session
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
        exit();
    } else {
        //If the username or password is incorrect, set an error message
        $error = "Invalid username or password";
    }
}
?>

<section class="login">
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
        <?php if (isset($error)): ?> <!-- checks if the variable $error is set-->
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </form>
</section>

<?php include 'footer.php'; ?>
