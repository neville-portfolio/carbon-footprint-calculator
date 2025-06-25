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

	<body>

</head>
<body>
<h1>Reduction Tasks</h1>

<section class="task-categories">
        <div class="category" id="category-1">
            <h2>Home Emissions</h2>
            <ul>
                <li>Switch to energy-efficient LED bulbs</li>
                <li>Use energy-efficient settings and appliances</li>
                <li>Improve window and door seals to prevent heat loss</li>
                <li>Invest in solar panels</li>
            </ul>
        </div>

        <div class="category" id="category-2">
            <h2>Food Emissions</h2>
            <ul>
                <li>Buy local and seasonal produce</li>
                <li>Reduce your dairy consumption</li>
                <li>Purchase more organic products</li>
                <li>Reduce your meals out</li>
            </ul>
        </div>

        <div class="category" id="category-3">
            <h2>Travel Emissions</h2>
            <ul>
                <li>Try carpool to reduce the number of vehicles in use</li>
                <li>Invest in an electric or hybrid vehicle</li>
                <li>Propose a hybrid working scheme if possible, to reduce travel requirements</li>
                <li>Walk or cycle whenever possible </li>
            </ul>
        </div>

        <div class="category" id="category-4">
            <h2>Goods Emissions</h2>
            <ul>
                <li>Buy second-hand items to reduce demand</li>
                <li>Choose products made from sustainable materials</li>
                <li>Invest in reusable options, minimising single-use plastics</li>
                <li>Opt to make purchases from sustainable brands</li>
            </ul>
        </div>

        <div class="category" id="category-5">
            <h2>Services Emissions</h2>
            <ul>
                <li>Switch to digital services rather than physical</li>
                <li>Opt for paperless billing and receipts</li>
                <li>Switch to a green energy provider</li>
                <li>Support services that are commited to carbon neutrality</li>
            </ul>
        </div>

        <div class="category" id="category-6">
            <h2>Other Emissions</h2>
            <ul>
                <li>Start a compost for your food waste</li>
                <li>Choose products with minimal or recyclable packaging</li>
                <li>Aim for a zero-waste lifestyle</li>
                <li>Improve your knowledge with local recycling options</li>
            </ul>
        </div>
    </section>
 
 </div>

 
</body>
</html>

  </body>
</html>
