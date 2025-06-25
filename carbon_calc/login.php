<?php
session_start();
include 'db.php';

// Initialize variables for error messages
$errorMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $inputPassword = $_POST['password'];

    // Prepare and execute the select statement
    $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $storedHash = $user['password']; 

        // Verify password
        if (password_verify($inputPassword, $storedHash)) {
            // Successful login
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $errorMessage = "Invalid password.";
        }
    } else {
        $errorMessage = "No user found with that email.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="logo.png" alt="Logo">
        </div>
        <h1 class="logo-text">EcoFootprint</h1>
        
        <?php if ($errorMessage): ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php"> 
            <div class="email-input">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="password-input">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <a href="forgotten-password.php" class="forgotten-password">Forgotten Password?</a>
            <button type="submit">Sign in</button>
        </form>
        
        <p class="sign-up-now">Haven't got an account yet?</p>
        <a href="register.php">
            <button type="button" class="sign-up">Sign up</button>
        </a>
    </div>

	<script>
    // Prevent going back to the previous page
    window.history.pushState(null, '', window.location.href);
    window.onpopstate = function() {
        window.history.pushState(null, '', window.location.href);
    };
</script>

</body>
</html>
