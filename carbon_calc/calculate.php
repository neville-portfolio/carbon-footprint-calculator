<?php
include 'auth.php';
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];

    $home_emissions = floatval ($_POST['home_emissions']); 
    $food_emissions = floatval($_POST['food_emissions'] ?? 0);
    $travel_emissions = floatval($_POST['travel_emissions'] ?? 0);
    $goods_emissions = floatval($_POST['goods_emissions'] ?? 0);
    $services_emissions = floatval($_POST['services_emissions'] ?? 0);
    $other_emissions = floatval($_POST['other_emissions'] ?? 0);

    // Total footprint
    $total_footprint = $home_emissions + $food_emissions + $travel_emissions + 
                       $goods_emissions + $services_emissions + $other_emissions;

    // Log the calculated carbon footprint values for debugging
    error_log("user_id: $user_id");
    error_log("home_emissions (calculated): $home_emissions");
    error_log("food_emissions: $food_emissions");
    error_log("travel_emissions: $travel_emissions");
    error_log("goods_emissions: $goods_emissions");
    error_log("services_emissions: $services_emissions");
    error_log("other_emissions: $other_emissions");
    error_log("total_footprint (calculated): $total_footprint");

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO carbon_footprints (user_id, created_at, total_footprint, home_emissions, food_emissions, travel_emissions, goods_emissions, services_emissions, other_emissions) VALUES (?, NOW(), ?, ?, ?, ?, ?, ?, ?)");

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Bind parameters for the SQL query
    $stmt->bind_param("iddddddd", $user_id, $total_footprint, $home_emissions, $food_emissions, $travel_emissions, $goods_emissions, $services_emissions, $other_emissions);

    // Execute statement
    if ($stmt->execute()) {
        // Redirect to dashboard
        echo '<script type="text/javascript">
				alert("Calculation successful!");
				window.location.href = "dashboard.php";
			</script>';
        exit();
    // Or provide error message
    } else {
        error_log("Error: " . $stmt->error);
        echo "An error occurred while saving your data. Please try again later.";
    }

    $stmt->close();
}
?>

