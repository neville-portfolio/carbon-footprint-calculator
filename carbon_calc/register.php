<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = trim($_POST['username']);
	$email = trim($_POST['email']);
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

	// Validate the inputs
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "Invalid email format.";
		exit();
	}
	
	if (strlen($password) < 8) {
		echo "Password must be at least 8 characters.";
		exit();
	}
	
	if ($password !== $confirm_password) {
		echo "Passwords do not match.";
		exit();
	} 
	
		
	$stmt = $conn->prepare("INSERT INTO Users (username, email, password) VALUES (?, ?, ?)");
	if ($stmt) {
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		$stmt->bind_param("sss", $username, $email, $hashed_password);
		
		if	($stmt->execute()) {
			$_SESSION['username'] = $username;
			$_SESSION['registration_success'] = true;
		} else {
			echo "Error. Registration not complete: " . $conn->error;
			exit();
		}
		
		$stmt->close();

	}
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign Up</title>
	<link rel="stylesheet" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

</head>
<body>
	<div class="container">
		<div class="header">
			<a href="login.php" class="back-arrow">&#8592</a>
		</div>
		<div class="logo">
			<img src="logo.png" alt="Logo">
		</div>
		<h1 class="logo-text">EcoFootprint</h1>
		<form method="POST" action="">
			
            <?php if (isset($_SESSION['registration_success']) && $_SESSION['registration_success'] === true): ?>
                <p id="submit-success" style="color: green; text-align: center; font-size: 18px;">Success! Redirecting shortly...</p>

                <script>
                    setTimeout(function() {
                        window.location.href = "login.php"; 
                    }, 3000); 
                </script>

                <?php
                unset($_SESSION['registration_success']);
                ?>
            <?php endif; ?>
			
			
			<div class="username-input">
				<input type="text" name="username" placeholder="Username" required>
			</div>
			<div class="email-input">
				<input type="email" name="email" placeholder="Email" required>
			</div>
			<div class="password-input">
				<input type="password" name="password" placeholder="Password" required>
			</div>
			<div class="confirm-password-input">
				<input type="password" name="confirm_password" placeholder="Confirm password" required>
			</div>
			<button type="submit">Sign up</button>
		</form>
		     

</body>
</html>
