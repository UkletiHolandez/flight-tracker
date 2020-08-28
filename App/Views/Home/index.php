<?php 
    $page = "home";
    require "./../App/Views/Templates/header.php";    
?>

    <!-- jumbotron -->
    <section class="jumbotron">
        <img src="public/assets/images/flight-board.png" alt="">
    </section>

    <!-- Grid boxes -->
    <section class="container mb-2">
        <div class="box-wrapper">
            <div class="box">
                <h2>Airlines</h2>
                <p class="mb-5">Search for all flights operated by an airline. Select an airline to follow active flights as well as their timetable.</p>
                <a class="btn" href="/airlineops/allAirlines">Search</a>
            </div>
            <div class="box">
                <h2>Airports</h2>
                <p class="mb-5">Interested in flights operated by your local or any other airport? Check arrivals and departures by selecting preferred airport.</p>
                <a class="btn" href="/airportops/allAirports">Search</a>
            </div>
            <div class="box">
                <h2>Flights</h2>
                <p class="mb-5">You have a flight number and you would like to know its position and ETA? Check the flight status below.</p>
                <a class="btn" href="/flightops/listFlights">Search</a>
            </div>
        </div>
    </section> 

<?php 
    require "./../App/Views/Templates/footer.php";    
?>
