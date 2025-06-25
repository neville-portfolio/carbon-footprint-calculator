

document.addEventListener('DOMContentLoaded', () => {
    // Define emission factors
    const homeElectricityEmissionFactor = 0.207; // kg CO2 per kWh 
    const homeGasEmissionFactor = 0.184; // kg CO2 per kWh
    
    const foodMeatEmissionFactor = 2.600; // kg CO2 per day
    const foodVegetarianEmissionFactor = 1.390; // kg CO2 per day
    const foodVeganEmissionFactor = 1.000; // kg CO2 per day
    const foodBeefEmissionFactor = 4.200; 
    const foodChickenEmissionFactor = 0.480; 
    const foodFishEmissionFactor = 0.700; 
    const foodDairyEmissionFactor = 4.200;
	const foodTakeawayEmissionFactor = 5.0; // kg CO2 per meal 
    
    const travelCarMilesEmissionFactor = 0.273; // kg CO2 per mile 
    const travelPublicEmissionFactor = 0.092; // kg CO2 per passenger mile
    const travelFlightEmissionFactor = 0.185; // kg CO2 per passenger mile
    const travelBusEmissionFactor = 0.071;
    const travelTrainEmissionFactor = 0.113;
    const travelShortEmissionFactor = 0.207;
    const travelLongEmissionFactor = 0.163;
    
    const goodsEmissionFactor = 0.648; // kg CO2 per £ 
    const goodsClothingEmissionFactor = 1.236; // kg per £
    const goodsFurnishingsEmissionFactor = 1.067; // kg per £
    const goodsAppliancesEmissionFactor = 0.191; // kg per £
    const goodsElectronicsEmissionFactor = 0.191; // kg per £
    const goodsEntertainmentEmissionFactor = 0.553; // kg per £
    
    const servicesEmissionFactor = 0.265; // kg CO2 per £
    const servicesHealthEmissionFactor = 0.327;	// kg per £
    const servicesVehicleEmissionFactor = 0.308; // kg per £
	const servicesPersonalEmissionFactor = 0.333; // kg per £
	const servicesMaintenanceEmissionFactor = 0.090; // kg per £
 
    const wasteEmissionFactor = 0.0004; // kg CO2 per gram
    const recycleEmissionFactor = 0.0002; // kg CO2 per gram
    const otherRecyclePaperEmissionFactor = 0.0002; // kg CO2 per gram
    const otherRecycleCardboardEmissionFactor = 0.0002; // kg CO2 per gram
    const otherRecyclePlasticEmissionFactor = 0.0001; // kg CO2 per gram
    const otherRecycleGlassEmissionFactor = 0.0002; // kg CO2 per gram
    const otherRecycleCansEmissionFactor = 0.0004; // kg CO2 per gram
    const otherRecycleFoodEmissionFactor = 0.0008; // kg CO2 per gram


    let dataEntered = {
        home: false,
        food: false,
        travel: false,
        goods: false,
        services: false,
        other: false
    }; 

	// Set default mode for categories
    let currentInputModes = {
        home: 'simple',
        food: 'simple',
        travel: 'simple',
        goods: 'simple',
        services: 'simple',
        other: 'simple'
    };
        
    // Open each tab
    function openTab(tabName) {
        const tabs = document.querySelectorAll('.tab-content');
        tabs.forEach(tab => {
            tab.style.display = 'none';
        });

		const activeTab = document.getElementById(tabName);
        if (activeTab) {
            activeTab.style.display = 'block';
            enforceInputMode(activeTab);
        }

        const tabButtons = document.querySelectorAll('.tab-button');
        tabButtons.forEach(button => {
            button.classList.remove('active');
        });
        const activeTabButton = document.querySelector(`.tab-button[data-tab="${tabName}"]`);
        if (activeTabButton) {
            activeTabButton.classList.add('active');
        }
    }

    // Enforce input modes
    function enforceInputMode(tabElement) {
        const simpleInputs = tabElement.querySelector('.simple-inputs');
        const detailedInputs = tabElement.querySelector('.detailed-inputs');

        // Check current input mode
        if (currentInputModes[tabElement.id] === 'simple') {
            simpleInputs.style.display = 'block'; 
            detailedInputs.style.display = 'none';
        } else {
            simpleInputs.style.display = 'none'; 
            detailedInputs.style.display = 'block'; 
        }
    }

    // Track data entry
    function trackDataEntry(tabId) {
        const simpleInputs = document.querySelectorAll(`#${tabId} .simple-inputs input`);
        const detailedInputs = document.querySelectorAll(`#${tabId} .detailed-inputs input`);

        const hasData = Array.from(simpleInputs).some(input => input.value) || 
                        Array.from(detailedInputs).some(input => input.value);

        dataEntered[tabId] = hasData;
        enforceInputMode(document.getElementById(tabId));
    }

    // Form submission
    const form = document.getElementById('carbon-footprint-form');
    form.addEventListener('submit', (event) => {
        event.preventDefault();

        // Gather input values
        const electricity = parseFloat(document.getElementById('electricity-use').value) || 0;
        const gas = parseFloat(document.getElementById('gas-use').value) || 0;
        
        // Food consumption inputs
        const dietType = document.getElementById('diet-type').value;
        const redMeatConsumption = parseFloat(document.getElementById('red-meat-consumption').value) || 0;
        const fishConsumption = parseFloat(document.getElementById('fish-consumption').value) || 0;
        const poultryConsumption = parseFloat(document.getElementById('poultry-consumption').value) || 0;
        const dairyConsumption = parseFloat(document.getElementById('dairy-consumption').value) || 0;
        const foodSpending = parseFloat(document.getElementById('food-spending').value) || 0;
		const foodSpendingD = parseFloat(document.getElementById('food-spending-detailed').value) || 0;

        // Travel inputs
        const carMiles = parseFloat(document.getElementById('car-miles').value) || 0;
        const publicTransportMiles = parseFloat(document.getElementById('public-transport-miles').value) || 0;
        const flightMiles = parseFloat(document.getElementById('flight-miles').value) || 0;
		
		const carMilesD = parseFloat(document.getElementById('car-miles-detailed').value) || 0;
		const busMiles = parseFloat(document.getElementById('bus-miles').value) || 0;
        const trainMiles = parseFloat(document.getElementById('train-miles').value) || 0;
        const flightMilesD = parseFloat(document.getElementById('flight-miles-detailed').value) || 0;
        const freqFlights = document.getElementById('frequent-flights').value.trim();

        // Goods spending inputs
        const goodsSpending = parseFloat(document.getElementById('goods-spending').value) || 0;
		const goodsClothing = parseFloat(document.getElementById('clothing').value) || 0;
		const goodsFurnishings = parseFloat(document.getElementById('furnishings').value) || 0;
		const goodsAppliances = parseFloat(document.getElementById('appliances').value) || 0;
		const goodsElectronics = parseFloat(document.getElementById('electronics').value) || 0;
		const goodsEntertainment = parseFloat(document.getElementById('entertainment').value) || 0;

        // Services spending inputs
        const servicesSpending = parseFloat(document.getElementById('services-spending').value) || 0;
        const servicesHealthcare = parseFloat(document.getElementById('healthcare').value) || 0;
        const servicesVehicle = parseFloat(document.getElementById('vehicle').value) || 0;
        const servicesPersonal = parseFloat(document.getElementById('personal').value) || 0;
        const servicesMaintenance = parseFloat(document.getElementById('maintenance').value) || 0;

        // Other - Waste and recycling inputs
        const waste = parseFloat(document.getElementById('waste').value) || 0;
        const wasteD = parseFloat(document.getElementById('waste-detailed').value) || 0;
        const recycle = parseFloat(document.getElementById('recycle').value) || 0;
        const recyclePaper = parseFloat(document.getElementById('recycle-paper').value) || 0;
        const recycleCardboard = parseFloat(document.getElementById('recycle-cardboard').value) || 0;
        const recyclePlastic = parseFloat(document.getElementById('recycle-plastic').value) || 0;
        const recycleGlass = parseFloat(document.getElementById('recycle-glass').value) || 0;
        const recycleCans = parseFloat(document.getElementById('recycle-cans').value) || 0;
        const recycleFood = parseFloat(document.getElementById('recycle-food').value) || 0;


        // Calculate carbon footprint
        const carbonFootprint = calculateCarbonFootprint(
            electricity, gas, 
            redMeatConsumption, fishConsumption, poultryConsumption, dairyConsumption, foodSpending, foodSpendingD,
            carMiles, publicTransportMiles, flightMiles, carMilesD, busMiles, trainMiles, flightMilesD, freqFlights, 
            goodsSpending, goodsClothing, goodsFurnishings, goodsAppliances, goodsElectronics, goodsEntertainment,
            servicesSpending, servicesHealthcare, servicesVehicle, servicesPersonal, servicesMaintenance,
            waste, wasteD, recycle, recyclePaper, recycleCardboard, recyclePlastic, recycleGlass, recycleCans, recycleFood, dietType
        );

        // Set hidden input for carbon footprint calculation
        document.getElementById('carbon_footprint').value = carbonFootprint.totalFootprint;

        // Display result
        document.getElementById('results-output').innerText = `Your estimated carbon footprint is: ${carbonFootprint.totalFootprint.toFixed(2)} kg CO2.`;
        document.getElementById('results').style.display = 'block';

		// Prepare data for database storage
		const dataToStore = {
			total_footprint: carbonFootprint.totalFootprint,
			home_emissions: carbonFootprint.homeEmissions,
			food_emissions: carbonFootprint.foodEmissions,
			travel_emissions: carbonFootprint.travelEmissions,
			goods_emissions: carbonFootprint.goodsEmissions,
			services_emissions: carbonFootprint.servicesEmissions,
			other_emissions: carbonFootprint.otherEmissions
		};
        form.submit();
    });

    // Function to calculate carbon footprint based on inputs
    function calculateCarbonFootprint(
        electricity, gas, redMeatConsumption, fishConsumption, poultryConsumption, dairyConsumption, foodSpending, foodSpendingD,
        carMiles, publicTransportMiles, flightMiles, carMilesD, busMiles, trainMiles, flightMilesD, freqFlights, 
        goodsSpending, goodsClothing, goodsFurnishings, goodsAppliances, goodsElectronics, goodsEntertainment,
        servicesSpending, servicesHealthcare, servicesVehicle, servicesPersonal, servicesMaintenance,
        waste, wasteD, recycle, recyclePaper, recycleCardboard, recyclePlastic, recycleGlass, recycleCans, recycleFood, dietType
    ) {
        // Calculate emissions from home energy
        const electricityEmissions = electricity * homeElectricityEmissionFactor;
        const gasEmissions = gas * homeGasEmissionFactor;

		console.log(`Electricity Emissions: ${electricityEmissions}`);
		console.log(`Gas Emissions: ${gasEmissions}`);


		const allHomeEmissions = electricityEmissions + gasEmissions


        // Calculate emissions from food consumption based on diet type
        let foodEmissions = 0;
		if (dietType === 'meat-eater') {
			if (redMeatConsumption > 0) {
				foodEmissions += ((foodMeatEmissionFactor * redMeatConsumption) * 365);
			foodEmissions += ((foodSpending * foodTakeawayEmissionFactor) * 12);
			}
		} else if (dietType === 'vegetarian') {
			foodEmissions += (foodVegetarianEmissionFactor * 365) + ((foodSpending * foodTakeawayEmissionFactor) * 12);
		} else if (dietType === 'vegan') {
			foodEmissions += (foodVeganEmissionFactor * 365) + ((foodSpending * foodTakeawayEmissionFactor) * 12);
		} else {
			foodEmissions += ((foodBeefEmissionFactor * redMeatConsumption) * 52) +
							 ((foodFishEmissionFactor * fishConsumption) * 52) +
							 ((foodChickenEmissionFactor * poultryConsumption) * 52) +
							 ((foodDairyEmissionFactor * dairyConsumption) * 52) +
							 ((foodTakeawayEmissionFactor * foodSpendingD) * 12);
		}
		
		//Debug
		console.log(`Food Emissions: ${foodEmissions}`);

		const allFoodEmissions = foodEmissions

        // Calculate emissions from travel
        const carEmissions = carMiles * travelCarMilesEmissionFactor;
        const publicTransportEmissions = publicTransportMiles * travelPublicEmissionFactor;
        const flightEmissions = flightMiles * travelFlightEmissionFactor;

		//Debug
		console.log(`Car Emissions: ${carEmissions}`);
		console.log(`Public Transport Emissions: ${publicTransportEmissions}`);
		console.log(`Flight Emissions: ${flightEmissions}`);


		const carEmissionsD = carMilesD * travelCarMilesEmissionFactor;
		const busEmissions = busMiles * travelBusEmissionFactor;
		const trainEmissions = trainMiles * travelTrainEmissionFactor;
		const flightEmissionsD = flightMilesD * travelFlightEmissionFactor;

		//Debug
		console.log("Frequent Flights Input:", freqFlights);

		
		let planeDetailed = 0;
		if (freqFlights === 'short') {
			planeDetailed += (flightEmissionsD > 0 ? travelShortEmissionFactor * flightMilesD : 0);
		} else if (freqFlights === 'long') {
			planeDetailed += (travelLongEmissionFactor * flightMilesD);
		} else {
			planeDetailed += (travelFlightEmissionFactor * flightMilesD);
		}
		
		//Debug
		console.log(`Car Emissions Detailed: ${carEmissionsD}`);
		console.log(`Bus Emissions: ${busEmissions}`);
		console.log(`Train Emissions: ${trainEmissions}`);
		console.log(`Plane Detailed: ${planeDetailed}`);

		const allTravelEmissions = carEmissions + publicTransportEmissions + flightEmissions + carEmissionsD + busEmissions + trainEmissions + planeDetailed;

        // Calculate emissions from goods spending
        const goodsEmissions = (goodsSpending * goodsEmissionFactor) * 12;

		//Debug
		console.log(`Goods Emissions: ${goodsEmissions}`);

		const goodsEmissionsD =  
			((goodsClothing * goodsClothingEmissionFactor) * 12) +
			((goodsFurnishings * goodsFurnishingsEmissionFactor) * 12) +
			((goodsAppliances * goodsAppliancesEmissionFactor) * 12) +
			((goodsElectronics * goodsElectronicsEmissionFactor) * 12) +
			((goodsEntertainment * goodsEntertainmentEmissionFactor) * 12);
			
		//Debug
		console.log(`Detailed Goods Emissions: ${goodsEmissionsD}`);

		const allGoodsEmissions = goodsEmissions + goodsEmissionsD;

        // Calculate emissions from services spending
        const servicesEmissions = (servicesSpending * servicesEmissionFactor) * 12;

		//Debug
		console.log(`Services Emissions: ${servicesEmissions}`);

		const servicesEmissionsD =    
			((servicesHealthcare * servicesHealthEmissionFactor) * 12) +
			((servicesVehicle * servicesVehicleEmissionFactor) * 12) +
			((servicesPersonal * servicesPersonalEmissionFactor) * 12) +
			((servicesMaintenance * servicesMaintenanceEmissionFactor) * 12);
			
		//Debug
		console.log(`Detailed Services Emissions: ${servicesEmissionsD}`);

		const allServicesEmissions = servicesEmissions + servicesEmissionsD;



		// Household waste 
		const wasteValue = {
			"below average" : 800,
			"average" : 1100,
			"above-average" : 1500
		};

		const recycleValues = {
			"no-recycling" : 0,
			"below-average" : 0.30,
			"average" : 0.45, 
			"above-average" : 0.60
		};

		const recyclingBreakdown = { 
			paper : 0.25, 
			cardboard : 0.20,
			plastic : 0.15,
			glass : 0.15,
			cans : 0.15,
			food : 0.10
		};

		const wasteLevel = document.getElementById('waste').value;
		const recycleLevel = document.getElementById('recycle').value;

		const selectedRecyclingTypes = [];
		const recyclingCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');

		recyclingCheckboxes.forEach(checkbox => {
			selectedRecyclingTypes.push(checkbox.value);
		});

		const wasteLevelValue = wasteValue[wasteLevel];
		const recyclePercentage = recycleValues[recycleLevel];

		let totalRecycle = wasteLevelValue * recyclePercentage;
		let totalRecycleValues = {
			paper: 0, 
			cardboard: 0, 
			plastic: 0,
			glass: 0,
			cans: 0,
			food: 0
		};

		selectedRecyclingTypes.forEach(type => {
			if(recyclingBreakdown[type]) {
				totalRecycleValues[type] = totalRecycle * recyclingBreakdown[type];
			}
		});

		const wasteEmissions = (wasteLevelValue * wasteEmissionFactor) * 365;
		const recycleEmissions = (totalRecycle * recycleEmissionFactor) * 365;

		const totalRecycleEmissions = 
			((totalRecycleValues.paper * otherRecyclePaperEmissionFactor) * 365) +
			((totalRecycleValues.cardboard * otherRecycleCardboardEmissionFactor) * 365) +
			((totalRecycleValues.plastic * otherRecyclePlasticEmissionFactor) * 365) +
			((totalRecycleValues.glass * otherRecycleGlassEmissionFactor) * 365) +
			((totalRecycleValues.cans * otherRecycleCansEmissionFactor) * 365) +
			((totalRecycleValues.food * otherRecycleFoodEmissionFactor) * 365);

		// Final total emissions
		const totalWasteEmissions = wasteEmissions - recycleEmissions;
		const totalWasteEmissionsD = totalWasteEmissions - totalRecycleEmissions;
		
		const allOtherEmissions = totalWasteEmissions + totalWasteEmissionsD

		// Debug for results
		console.log("Waste Level: " + wasteLevel);
		console.log("Recycle Level: " + recycleLevel);
		console.log("Selected Recycling Types: " + selectedRecyclingTypes.join(", "));
		console.log("Waste Emissions (kg CO2): " + totalWasteEmissions);
		console.log("Recycling Emissions (kg CO2): " + totalRecycleEmissions);
		console.log("Total Emissions (kg CO2): " + totalWasteEmissionsD);

		// Calculate the total footprint
		const totalFootprint = allHomeEmissions + 
								allFoodEmissions + 
								allTravelEmissions + 
								allGoodsEmissions + 
								allServicesEmissions + 
								allOtherEmissions;

		// Store the calculated values in hidden form fields
		document.getElementById('home_emissions').value = allHomeEmissions.toFixed(2);
		document.getElementById('food_emissions').value = allFoodEmissions.toFixed(2);
		document.getElementById('travel_emissions').value = allTravelEmissions.toFixed(2);
		document.getElementById('goods_emissions').value = allGoodsEmissions.toFixed(2);
		document.getElementById('services_emissions').value = allServicesEmissions.toFixed(2);
		document.getElementById('other_emissions').value = allOtherEmissions.toFixed(2);
		document.getElementById('total_footprint').value = totalFootprint.toFixed(2);

		// Submit form
		document.getElementById('carbon-footprint-form').submit();
   
		return {
			totalFootprint: totalFootprint,
			homeEmissions: allHomeEmissions,
			foodEmissions: allFoodEmissions,
			travelEmissions: allTravelEmissions,
			goodsEmissions: allGoodsEmissions,
			servicesEmissions: allServicesEmissions,
			otherEmissions: allOtherEmissions
		};
    }



    // Function to set the input mode ('simple' or 'detailed')
    window.selectMode = function(tabId, mode) {
        console.log(`selectMode called with tabId: ${tabId}, mode: ${mode}`); // Log the tabId and mode
        currentInputModes[tabId] = mode; // Update the current input mode for the tab
        enforceInputMode(document.getElementById(tabId)); // Enforce input mode for the active tab
    };

    // Listen for input changes to track data entry
    const allInputs = document.querySelectorAll('input[type="number"], input[type="text"]');
    allInputs.forEach(input => {
        input.addEventListener('input', (event) => {
            const tabId = event.target.closest('.tab-content').id;
            trackDataEntry(tabId);
        });
    });

    // Listen for tab button clicks to change tabs
    const tabButtons = document.querySelectorAll('.tab-button');
    tabButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const tabName = event.target.getAttribute('data-tab');
            openTab(tabName);
        });
    });

    // Initialize the first tab when the page loads
    openTab('home');
});
