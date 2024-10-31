<?php

// Check if there’s a cookie-stored username
$username = $_COOKIE['username'] ?? '';

// Debugging: Output the username and password from POST data for verification (remove in production)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

    // Check input values
    var_dump("Username entered: ", $username);
    var_dump("Password entered: ", $password);

    // Validate credentials (In this example, we're using 'user' and 'password')
    if ($username === 'user' && $password === 'password') {
        $_SESSION['username'] = $username;

        // Set a cookie if "Remember Me" is checked
        if (!empty($_POST['remember'])) {
            setcookie('username', $username, time() + (86400 * 30), "/");
        } else {
            // Clear the cookie if "Remember Me" is unchecked
            setcookie('username', '', time() - 3600, "/");
        }
        
        // Redirect upon successful login
        header("Location: index.php?page=home");
        exit;
    } else {
        // Display error if credentials are invalid
        $error = "Invalid credentials.";
    }
}
?>

<h2>Login</h2>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form action="" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" value="<?php echo $username; ?>" required>
    
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    
    <label>
        <input type="checkbox" name="remember" <?php if (!empty($_COOKIE['username'])) echo 'checked'; ?>> Remember Me
    </label>
    
    <button type="submit">Login</button>
</form>
