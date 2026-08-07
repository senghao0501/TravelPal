<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<link rel="stylesheet" href="/TravelPal/home/style.css">
</head>

<body>

	<?php include 'header.php'; ?>

<div id="scrollingView">

	<h2>Explore Southeast Asia<br>Thailand · Vietnam · Indonesia · Malaysia</h2>
	
	
	<div class="images" id="image-slider">
		<img src="/TravelPal/images/thailand.jpg" alt="Thailand">
		<img src="/TravelPal/images/thailand2.jpg" alt="Thailand">
		<img src="/TravelPal/images/vietnam.jpg" alt="Vietnam">
		<img src="/TravelPal/images/vietnam2.jpg" alt="Vietnam">
		<img src="/TravelPal/images/indonesia.jpg" alt="Indonesia">
		<img src="/TravelPal/images/indonesia2.jpg" alt="Indonesia">
		<img src="/TravelPal/images/malaysia.jpg" alt="Malaysia">
		<img src="/TravelPal/images/malaysia2.jpg" alt="Malaysia">
	</div>
	
</div>

<script>
	const slider = document.getElementById("image-slider");
	setInterval(() => {
		if(slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 5){
			slider.scrollTo({
				left:0,
				behavior:"smooth"
			});
		}else{
			slider.scrollBy({
				left:375,
				behavior:"smooth"
				});
			}
		}, 3000);
</script>

	<div class = "search">
		<input type="text" id="searchBar" placeholder = "Search a country">
		
		<button type="button" onclick="navigateSearch()" id="searching">
			<img src="/TravelPal/images/SearchIcon.jpg" alt = "Search icon" width = "20" height = "20">
		</button>
		
		<div class = "error-message" id = "searchError"></div>
	</div>
	

<script>
function navigateSearch(){
	
	const result = document.getElementById("searchBar").value.trim();
	
	const error = document.getElementById("searchError");
	
	error.textContent = "";
	
	const pages = {
		thailand: "Thailand",
		vietnam: "Vietnam",
		indonesia: "Indonesia",
		malaysia: "Malaysia"
	};
	
	if(result === ""){
		error.textContent = "Search cannot be blank.";
	}else if(pages[result.toLowerCase()]){
		window.location.href="/TravelPal/Attractions/" + pages[result.toLowerCase()];
	}else{
		error.textContent = "Country not found.";
	}
}

</script>

<div class = "viewMore">

	<dialog id = "travelPopup">
		<h3 id = "popupTitle"></h3>
		
		<div class = "popup-links">
			<a id = "flightLink">Flights</a>
			<a id = "hotelLink">Hotels</a>
			<a id = "restaurantLink">Restaurants</a>
			<a id = "attractionLink">Attractions</a>
		</div>
		
		<button type = "button" onclick = "closeTravelPopup()">Close</button>
	</dialog>
	
	<div class = "view-card">
		<h3>Thailand</h3>
		<img class = "place-image" src = "/TravelPal/images/thailand3.jpg" id = "nightMarket" alt = "Night market">
		<pre>· Waterfall  · Night Market</pre>
		<button type = "button" onclick="openTravelPopup('Thailand')">View more</button>
	</div>
	
	<div class = "view-card">
		<h3>Vietnam</h3>
		<img class = "place-image" src = "/TravelPal/images/vietnam3.jpg" id = "ancientTowns" alt = "Ancient towns">
		<pre>· Coffee  · Ancient Towns</pre>
		<button  type = "button" onclick="openTravelPopup('Vietnam')">View more</button>
	</div>
	
	<div class = "view-card">
		<h3>Indonesia</h3>
		<img class = "place-image" src = "/TravelPal/images/indonesia3.jpg" id = "mountBromo" alt = "Mount Bromo">
		<pre>· Sunrise  · Mount Bromo</pre>
		<button type = "button" onclick="openTravelPopup('Indonesia')">View more</button>
	</div>
	
	<div class = "view-card">
		<h3>Malaysia</h3>
		<img class = "place-image" src = "/TravelPal/images/malaysia3.jpg" id = "jonkerStreet" alt = "Jonker street">
		<pre>· Heritage  · Jonker Street</pre>
		<button type = "button" onclick="openTravelPopup('Malaysia')">View more</button>
	</div>
</div>

<script>
function openTravelPopup(country) {
    document.getElementById("popupTitle").textContent =
        "Explore " + country;

    document.getElementById("flightLink").href =
        "/TravelPal/Flights/" + country;

    document.getElementById("hotelLink").href =
        "/TravelPal/Hotels/" + country;

    document.getElementById("restaurantLink").href =
        "/TravelPal/Restaurants/" + country;

    document.getElementById("attractionLink").href =
        "/TravelPal/Attractions/" + country;

    document.getElementById("travelPopup").showModal();
}

function closeTravelPopup() {
    document.getElementById("travelPopup").close();
}
</script>
	
	<div>
			<h2 class="section-title">Top Picks</h2>
	</div>
	
<div class = "top-picks-wrapper">	

<div id = "topPicks">

	<div class = "pick-card">
		<img class = "place-image" src = "/TravelPal/images/thailand4.jpg" alt = "The Grand Palace">
		<p>The Grand Palace, Thailand</p>
		 <div class="rating">
            <img src="/TravelPal/images/ratingStar.png" alt="Rating">
            <span>4.7</span>
        </div>
	</div>
	<div class = "pick-card">
		<img class = "place-image" src = "/TravelPal/images/vietnam4.jpg" alt = "Ha Long Bay">
		<p>Ha Long Bay, Vietnam</p>
		 <div class="rating">
            <img src="/TravelPal/images/ratingStar.png" alt="Rating">
            <span>4.8</span>
        </div>
	</div>
	<div class = "pick-card">
		<img class = "place-image" src = "/TravelPal/images/indonesia.jpg" alt = "Prambanan Temple">
		<p>Prambanan Temple, Indonesia</p>
		 <div class="rating">
            <img src="/TravelPal/images/ratingStar.png" alt="Rating">
            <span>4.5</span>
        </div>
	</div>
	<div class = "pick-card">
		<img class = "place-image" src = "/TravelPal/images/malaysia.jpg" alt = "Batu Caves">
		<p>Batu Caves, Malaysia</p>
		 <div class="rating">
            <img src="/TravelPal/images/ratingStar.png" alt="Rating">
            <span>4.9</span>
        </div>		
	</div>
	<div class = "pick-card">
		<img class = "place-image" src = "/TravelPal/images/thailand5.jpg" alt = "Damnoen Saduak Floating Market">
		<p>Damnoen Saduak Floating Market, Thailand </p>
		 <div class="rating">
            <img src="/TravelPal/images/ratingStar.png" alt="Rating">
            <span>4.9</span>
        </div>		
	</div>
	<div class = "pick-card">
		<img class = "place-image" src = "/TravelPal/images/vietnam5.jpg" alt = "Hanoi Old Quarter">
		<p>Hanoi Old Quarter, Vietnam</p>
		 <div class="rating">
            <img src="/TravelPal/images/ratingStar.png" alt="Rating">
            <span>4.8</span>
        </div>		
	</div>
	<div class = "pick-card">
		<img class = "place-image" src = "/TravelPal/images/indonesia4.jpg" alt = "Komodo National Park">
		<p>Komodo National Park, Indonesia</p>
		 <div class="rating">
            <img src="/TravelPal/images/ratingStar.png" alt="Rating">
            <span>4.6</span>
        </div>		
	</div>
	<div class = "pick-card">
		<img class = "place-image" src = "/TravelPal/images/malaysia4.jpg" alt = "Cameron Highlands">
		<p>Cameron Highlands, Malaysia</p>
		 <div class="rating">
            <img src="/TravelPal/images/ratingStar.png" alt="Rating">
            <span>4.9</span>
        </div>		
	</div>
	
</div>

	<button class = "next-arrow" type = "button" onclick = "showNextPicks()">&#10095;</button>
	
</div>

<script>
function showNextPicks() {
    const topPicks = document.getElementById("topPicks");
    const cards = topPicks.querySelectorAll(".pick-card");

    if (topPicks.scrollLeft > 5) {
        topPicks.scrollTo({
            left: 0,
            behavior: "smooth"
        });
    } else {
        topPicks.scrollTo({
            left: cards[4].offsetLeft - cards[0].offsetLeft,
            behavior: "smooth"
        });
    }
}
</script>

<?php include 'footer.php'; ?>

</body>

</html>