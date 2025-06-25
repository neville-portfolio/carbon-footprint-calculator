<?php
session_start();

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}

require_once 'db.php';

// Username and user_id 
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];


// Last calculation 
$query = "SELECT total_footprint FROM carbon_footprints WHERE user_id = ? ORDER BY created_at DESC LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($total_footprint);

if ($stmt->fetch()) {
} else {
	$total_footprint = "No calculation available";
}

$stmt->close();

// Calculation breakdown
$query = "SELECT home_emissions, food_emissions, travel_emissions, goods_emissions, services_emissions, other_emissions FROM carbon_footprints WHERE user_id = ? ORDER BY created_at DESC LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($home_emissions, $food_emissions, $travel_emissions, $goods_emissions, $services_emissions, $other_emissions);

if ($stmt->fetch()) {
} else {
	    $home_emissions = $food_emissions = $travel_emissions = $goods_emissions = $services_emissions = $other_emissions = "No calculation available";
}

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
		
	<main>
		<h2>Hello <span id="username"><?php echo $username; ?></span></h2>

		<div class="main-profile">
			<div class="left-column">
				<div class="carbon-footprint">
					<p>My Carbon Footprint: <span id="total_footprint"><?php echo $total_footprint; ?></span> kg of C02 per year</p>
					
					<canvas id="carbonFootprintChart"></canvas>
					<style>
						#carbonFootprintChart {
							width: 100%;
							max-width: 700px;
							height: auto;
						}
					</style>
					
					<script>
					const chartData = {
						labels: ['Home Emissions', 'Food Emissions', 'Travel Emissions', 'Goods Emissions', 'Services Emissions', 'Other Emissions'],
						datasets: [{
							label: 'Carbon Footprint Breakdown',
							data: [<?php echo $home_emissions; ?>, <?php echo $food_emissions; ?>, <?php echo $travel_emissions; ?>, <?php echo $goods_emissions; ?>, <?php echo $services_emissions; ?>, <?php echo $other_emissions; ?>],
							backgroundColor: ['#44713A', '#81CC70', '#585A60', '#8A8F9B', '#DDE0E7', '#BBE8C5' ],
							borderWidth: 1
						}]
					};
					const ctx = document.getElementById('carbonFootprintChart').getContext('2d');
					const carbonFootprintChart = new Chart(ctx, {
						type: 'pie',  
						data: chartData,
						options: {
							responsive: true,
							plugins: {
								legend: {
									position: 'top',
								},
								tooltip: {
									callbacks: {
										label: function(tooltipItem) {
											return tooltipItem.label + ': ' + tooltipItem.raw + ' kg CO₂';
										}
									}
								}
							}
						}
					});
					</script>
					
				</div>	
			</div>

			<div class="right-column">
				<section id="tracking-overview">
					<h3>Tracking Overview</h3>
					<div class="wrapper">
						<header>
							<p class="current-date"></p>
							<div class="icons">
								<span id="prev" class="material-symbols-rounded">chevron_left</span>
								<span id="next" class="material-symbols-rounded">chevron_right</span>
							</div>
						</header>
						<div class="calendar">
							<ul class="weeks">
								<li>Sun</li>
								<li>Mon</li>
								<li>Tue</li>
								<li>Wed</li>
								<li>Thu</li>
								<li>Fri</li>
								<li>Sat</li>
							</ul>
							<ul class="days"></ul>
						</div>
					</div>
					<a href="input.php">
						<button id="input-activity">Input New Activities</button>
					</a>
				</section>
			</div>
		</div>
	</main>

	<script src="toggle.js"></script>

</body>
<h3>My Current Goals</h3>
	<div class="container swiper">
		<div class="goal-wrapper">
			<ul class="goal-list swiper-wrapper">
				<li class="goal-item swiper-slide">
					<a href="tasks.php" class="goal-link">
						<p class="group-category">Home</p>
						<h2 class="goal-text">Turn electical equipment off at the switch when not in use</h2>
						<button class="goal-button material-symbols-rounded">arrow_forward</button>
					</a>
				</li>
				<li class="goal-item swiper-slide">
					<a href="tasks.php" class="goal-link">
						<p class="group-category">Food</p>
						<h2 class="goal-text">Try meat free days to reduce your meat consumption</h2>
						<button class="goal-button material-symbols-rounded">arrow_forward</button>
					</a>
				</li>
				<li class="goal-item swiper-slide">
					<a href="#" class="goal-link">
						<p class="group-category">Travel</p>
						<h2 class="goal-text">Take the bus or train instead of driving</h2>
						<button class="goal-button material-symbols-rounded">arrow_forward</button>
					</a>
				</li>
				
				<li class="goal-item swiper-slide">
					<a href="tasks.php" class="goal-link">
						<p class="group-category">Goods</p>
						<h2 class="goal-text">Aim to repair or upcycle items, rather than making a new purchase</h2>
						<button class="goal-button material-symbols-rounded">arrow_forward</button>
					</a>
				</li>
				
				<li class="goal-item swiper-slide">
					<a href="tasks.php" class="goal-link">
						<p class="group-category">Services</p>
						<h2 class="goal-text">Change to local, sustainable services</h2>
						<button class="goal-button material-symbols-rounded">arrow_forward</button>
					</a>
				</li>
				<li class="goal-item swiper-slide">
					<a href="tasks.php" class="goal-link">
						<p class="group-category">Other</p>
						<h2 class="goal-text">Recycle as much as possible</h2>
						<button class="goal-button material-symbols-rounded">arrow_forward</button>
					</a>
				</li>
			</ul>
			<div class="swiper-pagination"></div>
			<div class="swiper-slide-button swiper-button-prev"></div>
			<div class="swiper-slide-button swiper-button-next"></div>
		</div> 	
	</div>
	<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
	<script src="scriptgoals.js"></script>
	</div>	
</html>
