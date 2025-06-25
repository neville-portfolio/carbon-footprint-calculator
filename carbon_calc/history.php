<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
	die("User ID not found");
}

$user_id = $_SESSION['user_id'];

$query = "SELECT total_footprint, created_at FROM carbon_footprints WHERE user_id = ? ORDER BY created_at ASC";
$stmt = $conn->prepare($query);

//Error Check
//if ($stmt === false) {
//    die("Error preparing statement: " . $conn->error);
//}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($total_footprint, $created_at);

$dates = [];
$footprint_values = [];

while ($stmt->fetch()) {
//Debug
//	echo "Fetched: $total_footprint, $created_at<br>";
	
	$user_id = $user_id;
    $dates[] = date('Y-m-d', strtotime($created_at));
    $footprint_values[] = $total_footprint;
}

//Debug
//echo "User ID: " . $user_id . "<br>";


//Check if the arrays are populated
//if (empty($dates) || empty($footprint_values)) {
    //echo "No data fetched.<br>";
//} else {
    //echo "Data fetched successfully.<br>";
    //echo "Dates: <pre>" . print_r($dates, true) . "</pre>";
    //echo "Footprint Values: <pre>" . print_r($footprint_values, true) . "</pre>";
//}

$stmt->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale-1.0">
	<title>EcoFootprint Dashboard</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
	<link rel="stylesheet"   href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
	<script src="script.js"defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
	<header class="top-banner">
		<div class="logo">
			<a href="dashboard.php">
				<img src="logo.png" alt="Logo">
			</a>
			<a href="dashboard.php">
				<h1 class= "logo-text">EcoFootprint</h1>
			</a>
		</div>
		<div class="profile">
			<a href="dashboard.php">	
				<img src="profile-pic.png" alt="Profile Picture" class="profile-pic" />
			</a>
			<button id="logout" onclick="location.href='logout.php'">Logout</button>
		</div>
	</header>
	<nav id="navbar" class="navbar">
		<ul>
			<li><a href="dashboard.php" class="home">Home</a></li>
			<div class="nav-toggle">
				<li><a href="input.php">Activity Input</a></li>
				<li><a href="history.php">History</a></li>
				<li><a href="tasks.php">Tasks</a></li>
			</div>
		</ul>
		<button id="menu-toggle" class="menu">
			<div class="icon-open">
				<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="45"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6l16 0" /><path d="M4 12l16 0" /><path d="M4 18l16 0" /></svg>
			</div>
			<div class="icon-close">
				<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="45"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
			</div>
		</button>
	</nav>
		
	<script src="toggle.js"></script>
	<main>



    <h1>Historical Data</h1>
	<canvas id="carbonFootprintHistory"></canvas>
	<script>
			// Get PHP data for chart
			const dates = <?php echo json_encode($dates); ?>;
			const footprintValues = <?php echo json_encode($footprint_values); ?>;

			console.log("Dates:", dates);
			console.log("Footprint Values:", footprintValues);


			if (dates.length === 0 || footprintValues.length === 0) {
				console.error("No data available for graph.");
			}
			
			// Get canvas context
			const ctx = document.getElementById('carbonFootprintHistory').getContext('2d');

			// Create chart
			const footprintHistory = new Chart(ctx, {
				type: 'line',  
				data: {
					labels: dates,
					datasets: [{
						label: 'Total Carbon Footprint (kg CO₂)', 
						data: footprintValues, 
						borderColor: '#4CAF50',  
						backgroundColor: 'rgba(76, 175, 80, 0.2)', 
						fill: false,  
						borderWidth: 2,
						pointRadius: 5,  
						pointBackgroundColor: '#4CAF50'  
					}]
				},
				options: {
					responsive: true,
					scales: {
						x: {
							title: {
								display: true,
								text: 'Date'
							}
						},
						y: {
							title: {
								display: true,
								text: 'Total Footprint (kg CO₂)'
							},
							beginAtZero: true  
						}
					}
				}
			});
		</script>



</body>
</html>
