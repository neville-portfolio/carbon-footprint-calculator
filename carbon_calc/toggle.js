// Add event listener to handle active page
document.addEventListener("DOMContentLoaded", () => {
    const links = document.querySelectorAll(".navbar a");
    const currentPage = window.location.pathname; 

    // Remove the 'active' class from all links
    links.forEach(link => link.classList.remove("active"));

    // Loop through all links and add the active
    links.forEach(link => {
        if (link.href.includes(currentPage)) {
            link.classList.add("active");
        }
    });

    // Mobile menu toggle
	const menuToggle = document.querySelector("#menu-toggle");
	const navbar = document.querySelector("#navbar");

	//Debug
	console.log("menuToggle: ", menuToggle);
	console.log("navbar: ", navbar); 

	if (menuToggle) {
		console.log("Menu toggle found"); 


		// Event listener for toggling the navbar on click
		menuToggle.addEventListener("click", () => {
			console.log("Menu button clicked!"); 
			navbar.classList.toggle("open"); 
		});
	} else {
		console.log("Menu toggle not found");
	}
    
    links.forEach(link => {
		link.addEventListener("click", () => {
			if (window.innerWidth <= 700) {
				navbar.classList.remove("open");
				const navLinks = document.querySelector(".navbar .nav-toggle ul");
				navLinks.classList.remove("open");
			}
		});
	});
});
