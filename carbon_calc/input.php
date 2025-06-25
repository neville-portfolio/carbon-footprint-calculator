<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carbon Footprint Calculator</title>
    <link rel="stylesheet" href="styles.css">
    <script src="inputscript.js" defer></script>
    <script src="toggle.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
</head>
<body>

<header class="top-banner">
    <div class="logo">
        <a href="dashboard.php">
            <img src="logo.png" alt="Logo">
        </a>
        <a href="dashboard.php">
            <h1 class="logo-text">EcoFootprint</h1>
        </a>
    </div>
    <div class="profile">    
        <img src="profile-pic.png" alt="Profile Picture" class="profile-pic" onclick="dashboard.php" />
        <button id="logout" href='logout.php'>Logout</button>
    </div>
</header>

<nav id="navbar" class="navbar">
    <ul>
        <li><a href="dashboard.php" class="home" onclick="setActiveNavbar(this)">Home</a></li>
        <div class="nav-toggle">
            <li><a href="input.php" onclick="setActiveNavbar(this)">Activity Input</a></li>
            <li><a href="history.php" onclick="setActiveNavbar(this)">History</a></li>
            <li><a href="tasks.php" onclick="setActiveNavbar(this)">Tasks</a></li>
        </div>
    </ul>
    <button id="menu-toggle" class="menu">
        <div class="icon-open">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="45" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M4 6l16 0" />
                <path d="M4 12l16 0" />
                <path d="M4 18l16 0" />
            </svg>
        </div>
        <div class="icon-close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="45" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M18 6l-12 12" />
                <path d="M6 6l12 12" />
            </svg>
        </div>
    </button>
</nav>

<div class="container">
    <div class="tabs">
        <button class="tab-button active" data-tab="home" onclick="openTab('home')">Home</button>
        <button class="tab-button" data-tab="food" onclick="openTab('food')">Food</button>
        <button class="tab-button" data-tab="travel" onclick="openTab('travel')">Travel</button>
        <button class="tab-button" data-tab="goods" onclick="openTab('goods')">Goods</button>
        <button class="tab-button" data-tab="services" onclick="openTab('services')">Services</button>
        <button class="tab-button" data-tab="other" onclick="openTab('other')">Other</button>
    </div>

	<div>
		<h1>Calculate Your Carbon Footprint</h1>
		<form id="carbon-footprint-form" method="POST" action="calculate.php">
		<p class="reminder" style="border: 1px solid darkgreen; padding: 10px; margin-bottom: 20px; text-align: center; font-size: 0.8rem; font-style: italic;">
			Please enter input for either the simple or the detailed options, otherwise your carbon footprint estimation accuracy will be affected.
		</p>
	</div>
	
	<div id="home" class="tab-content">
		<div class="content">

			<label for="energy-use-home">Please enter your yearly estimated energy usage</label>
			<small id="energyHelp">Estimated values: Low Usage = ~2000kWh Average Usage = ~3000kWh High Usage = ~4000kWh</small>

			<input type="number" id="electricity-use" name="electricity" min="0" placeholder="Electricity estimation (kWh)">

							
			<label for="gas-use">Please enter your yearly estimated gas usage</label>
			<small id="gasHelp">Estimated values: Low Usage = ~6500kWh Average Usage = ~10000kWh High Usage = ~15000kWh</small>

			<input type="number" id="gas-use" name="gas" min="0" placeholder="Gas estimation (kWh)">

		</div>
	</div>

		

			<div id="food" class="tab-content">
				<div class="content">
					<div class="toggle">
						<label>
							<input type="radio" name="mode-food" value="simple" onclick="selectMode('food', 'simple')" checked> Simple
						</label>
						<label>
							<input type="radio" name="mode-food" value="detailed" onclick="selectMode('food', 'detailed')"> Detailed
						</label>
					</div>    

					<div class="simple-inputs">
						<label for="diet-type">How would you best describe your diet?</label>
						<select id="diet-type" name="diet-type">
							<option value=""?>Please select your diet type</option>
							<option value="meat-eater">Meat-eater</option>
							<option value="vegetarian">Vegetarian</option>
							<option value="vegan">Vegan</option>
						</select> 
						
						<label for="food-spending">How much do you typically spend on food, outside of your groceries, per month? (£)</label>
						<input type="number" id="food-spending" name="food-spending" min="0" placeholder="£">
					</div>

					<div class="detailed-inputs" style="display:none;">
						<p> Considering your meals over a typical week, please answer the following:</p>
						<label for="red-meat-consumption"> How often do you typically consume red meat?</label>
						<input type="number" id="red-meat-consumption" name="red-meat-consumption" min="0" placeholder="Weekly red meat consumption">
						
						<label for="fish-consumption">How often do you typically consume fish or seafood?</label>
						<input type="number" id="fish-consumption" name="fish-consumption" min="0" placeholder="Weekly fish/seafood consumption">
						
						<label for="poultry-consumption">How often do you typically consume poultry or eggs?</label>
						<input type="number" id="poultry-consumption" name="poultry-consumption" min="0" placeholder="Weekly poultry/egg consumption">
						
						<label for="dairy-consumption">How often do you typically consume dairy?</label>
						<input type="number" id="dairy-consumption" name="dairy-consumption" min="0" placeholder="Weekly dairy consumption">

						<label for="food-spending-detailed">How much do you typically spend on food, outside of your groceries, per month? (£)</label>
						<input type="number" id="food-spending-detailed" name="food-spending-detailed" min="0" placeholder="£">
					</div>
					

				</div>
			</div>

			<div id="travel" class="tab-content">
				<div class="content">
					<div class="toggle">
						<label>
							<input type="radio" name="mode-travel" value="simple" onclick="selectMode('travel', 'simple')" checked> Simple
						</label>
						<label>
							<input type="radio" name="mode-travel" value="detailed" onclick="selectMode('travel', 'detailed')"> Detailed
						</label>
					</div>    

					<div class="simple-inputs">
						<label for="car-miles">Please estimate the number of miles you travel by car, each year (miles)</label>
						<input type="number" id="car-miles" name="car-miles" min="0" placeholder="Miles by car">

						<label for="public-transport-miles">Please estimate the number of miles you travel by public transportation, each year (miles)</label>
						<input type="number" id="public-transport-miles" name="public-transport-miles" min="0" placeholder="Miles by public transport">
						
						<label for="flight-miles">Please estimate the number of miles you fly, each year (miles)</label>
						<input type="number" id="flight-miles" name="flight-miles" min="0" placeholder="Flight miles">
					</div>

					<div class="detailed-inputs" style="display:none;">
						<label for="car-miles-detailed">How many miles do you travel by car, each year? (miles)</label>
						<input type="number" id="car-miles-detailed" name="car-miles-detailed" min="0" placeholder="Miles by car">
						
						<label for="bus-miles">How many miles do you travel by bus? (miles)</label>
						<input type="number" id="bus-miles" name="bus-miles" min="0" placeholder="Miles by bus">
						
						<label for="train-miles">How many miles do you travel by train? (miles)</label>
						<input type="number" id="train-miles" name="train-miles" min="0" placeholder="Miles by train">
						
						<label for="flight-miles-detailed">How many miles do you fly? (miles)</label>
						<input type="number" id="flight-miles-detailed" name="flight-miles-detailed" min="0" placeholder="Flight miles">
						
						<label for="frequent-flights">What type of flight do you most frequently take?</label>
						<select id="frequent-flights"  name="frequent-flights">
							<option value="">Select your most frequent flight type</option>
							<option value="short">Short-haul</option>
							<option value="long">Long-haul</option>
						</select> 
						<small id="flightHelp">Short-haul = Less than 3 hours or 800 miles</small>

					</div>
				</div>
			</div>

			<div id="goods" class="tab-content">
				<div class="content">
					<div class="toggle">
						<label>
							<input type="radio" name="mode-goods" value="simple" onclick="selectMode('goods', 'simple')" checked> Simple
						</label>
						<label>
							<input type="radio" name="mode-goods" value="detailed" onclick="selectMode('goods', 'detailed')"> Detailed
						</label>
					</div>    

					<div class="simple-inputs">
						<label for="goods-spending">How much do you typically spend on goods, per month? (£)</label>
						<input type="number" id="goods-spending" name="goods-spending" placeholder="£">
					</div>

					<div class="detailed-inputs" style="display:none;">
						<label for="clothing">How much do you typically spend on clothing and/or footwear, per month?</label>
						<input type="number" id="clothing" name="clothing" placeholder="£">
						
						<label for="furnishings">How much do you typically spend on furnishings, per month?</label>
						<input type="number" id="furnishings" name="furnishings" placeholder="£">
						
						<label for="appliances">How much do you typically spend on household appliances, per month?</label>
						<input type="number" id="appliances" name="appliances" placeholder="£">
						
						<label for="electronics">How much do you typically spend on electronics and/or gadgets, per month?</label>
						<input type="number" id="electronics" name="electronics" placeholder="£">
						
						<label for="entertainment">How much do you typically spend on entertainment, per month?</label>
						<input type="number" id="entertainment" name="entertainment" placeholder="£">
					</div>
					
				</div>
			</div>

			<div id="services" class="tab-content">
				<div class="content">
					<div class="toggle">
						<label>
							<input type="radio" name="mode-services" value="simple" onclick="selectMode('services', 'simple')" checked> Simple
						</label>
						<label>
							<input type="radio" name="mode-services" value="detailed" onclick="selectMode('services', 'detailed')"> Detailed
						</label>
					</div>    

					<div class="simple-inputs">
						<label for="services-spending">How much do you typically spend on services, per month?</label>
						<input type="number" id="services-spending" name="services-spending" placeholder="£">
					</div>

					<div class="detailed-inputs" style="display:none;">
						<label for="healthcare">How much do you typically spend on health care services, per month?</label>
						<input type="number" id="healthcare" name="healthcare" placeholder="£">
						
						<label for="vehicle">How much do you typically spend on vehicle services, per month?</label>
						<input type="number" id="vehicle" name="vehicle" placeholder="£">
						
						<label for="personal">How much do you typically spend on personal or business related services, per month?</label>
						<input type="number" id="personal" name="personal" placeholder="£">

						<label for="maintenance">How much do you typically spend on household maintenance, per month?</label>
						<input type="number" id="maintenance" name="maintenance" placeholder="£">
					</div>
									
				</div>
			</div>

			<div id="other" class="tab-content">
				<div class="content">
					<div class="toggle">
						<label>
							<input type="radio" name="mode-other" value="simple" onclick="selectMode('other', 'simple')" checked> Simple
						</label>
						<label>
							<input type="radio" name="mode-other" value="detailed" onclick="selectMode('other', 'detailed')"> Detailed
						</label>
					</div>    

				   <div class="simple-inputs">
						<label for="waste">What would you estimate your waste generation to be, compared to that of a similar household size?</label>
						<select id="waste" name="waste">
							<option value=""?>Please estimate your waste generation</option>
							<option value="below average">Below Average</option>
							<option value="average">Average</option>
							<option value="above-average">Above Average</option>
						</select>
		
						<label for="recycle">How much do you recycle?</label>
						<select id="recycle" name="recycle">
							<option value=""?>Please estimate your recycling contribution</option>
							<option value="no-recycling">No Recycling</option>
							<option value="below-average">Below Average</option>
							<option value="average">Average</option>
							<option value="above-average">Above Average</option>
						</select>
						
						<button type="submit" style="display: block; margin: 0 auto; background-color: darkgreen; color: white;">Calculate</button>

					</div>

					<div class="detailed-inputs" style="display:none;">
						<label for="waste-detailed">What would you estimate your waste generation to be, compared to that of a similar household size?</label>
						<select id="waste-detailed" name="waste-detailed">
							<option value=""?>Please estimate your waste generation</option>
							<option value="below average">Below Average</option>
							<option value="average">Average</option>
							<option value="above-average">Above Average</option>
						</select>
		
						<div class="recycling-options">
						<label>Which of these do you typically recycle?</label>
		
						<div class="checkbox-container">
							<div class="checkbox-item">
								<input type="checkbox" id="recycle-paper" value="paper">
								<label for="recycle-paper">Paper</label>
							</div>
						
							<div class="checkbox-item">
								<input type="checkbox" id="recycle-cardboard" value="cardboard">
								<label for="recycle-cardboard">Cardboard</label>
							</div>
							
							<div class="checkbox-item">
								<input type="checkbox" id="recycle-plastic" value="plastic">
								<label for="recycle-plastic">Plastic</label>
							</div>
							
							<div class="checkbox-item">
								<input type="checkbox" id="recycle-glass" value="glass">
								<label for="recycle-glass">Glass</label>
							</div>
							
							<div class="checkbox-item">
								<input type="checkbox" id="recycle-cans" value="cans">
								<label for="recycle-cans">Cans/Tins</label>
							</div>
							
							<div class="checkbox-item">
								<input type="checkbox" id="recycle-food" value="food">
								<label for="recycle-food">Food</label>
							
							</div>

						</div>

				</div>
						   
		
				<button type="submit" style="display: block; margin: 0 auto; background-color: darkgreen; color: white;">Calculate</button>

        </div>
        </div>



	<input type="hidden" id="total_footprint" name="total_footprint">
	<input type="hidden" id="home_emissions" name="home_emissions">
	<input type="hidden" id="food_emissions" name="food_emissions">
	<input type="hidden" id="travel_emissions" name="travel_emissions">
	<input type="hidden" id="goods_emissions" name="goods_emissions">
	<input type="hidden" id="services_emissions" name="services_emissions">
	<input type="hidden" id="other_emissions" name="other_emissions">

    <input type="hidden" id="carbon_footprint" name="carbon_footprint">

        

    </form>

    <div id="carbon_footprint" style="display:none;">
        <h2>Results</h2>
        <p id="results-output">Success! Redirecting shortly...</p>
    </div>
    
    <script>
    
    // Show results message
    document.getElementById("carbon-footprint-form").addEventListener("submit", function(event) {
		event.preventDefault();
		
		document.getElementById("carbon_footprint").style.display = "block";


    // Pause for success message 
    setTimeout(function() {
        // Redirect to dashboard 
        window.location.href = "dashboard.php"; 
    }, 3000); 
    
	</script>
</div>
</body>
</html>
