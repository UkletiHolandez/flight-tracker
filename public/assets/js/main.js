$(function() {

    // responsive menu
    $(".menu-toggle").on("click", function() {
        if ($("nav").hasClass("opened")) {
            $("nav").removeClass("opened");
        } else {
            $("nav").addClass("opened");
        }
        
    });

    // Display list of flights for selected airline
    $(".select-box-airline").change(function() {
        var selectedAirline = $(".select-box-airline").val();
        $("#table-airlines-data").load("/airlineops/flightsbyairline", { airline: selectedAirline }, function() {
            // placeholder for callback function
            $("#airline-flight-list").text("Active flights for " + $(".select-box-airline option:selected").text());
        });
    });

    // Display list of flights on selected airport
    $(".select-box-airport").change(function() {
        var selectedAirport = $(".select-box-airport").val();
        $("#table-airports-data").load("/airportops/flightsbyairport", { airport: selectedAirport }, function() {
            // placeholder for callback function
            $("#airport-flight-list").text("Arrivals to " + $(".select-box-airport option:selected").text());
        });
    });

    // Initialize Map on Flights Page
    $("#map").on('load', function() {
        initMap();
    });

    // Set marker/flight on the map
    $(".fa-location-arrow").on('click', function() {
        var geoAlt = ($(this).parents().eq(1).attr("data-geo-alt"));
        var geoDir = ($(this).parents().eq(1).attr("data-geo-dir"));
        var geoLat = ($(this).parents().eq(1).attr("data-geo-lat"));
        var geoLng = ($(this).parents().eq(1).attr("data-geo-lng"));
        
        var flightDetails = {
            flightNumber: $(this).parent().siblings().children("h2").html(),
            flightIataCodeDep: $(this).parents().eq(1).siblings(".flight-plan").children("#origin").children(".iata").html(),
            flightIataCodeArr: $(this).parents().eq(1).siblings(".flight-plan").children("#dest").children(".iata").html(),
            flightDepTime: $(this).parents().eq(1).siblings(".flight-time").children("#dep-time").children(".act-time").html(),
            flightArrTime: $(this).parents().eq(1).siblings(".flight-time").children("#arr-time").children(".sch-time").html()
        };
                
        setMarker(geoLat, geoLng, Math.round(geoDir), flightDetails);

        // Highlight location icon after the flight is displayed on the map
        $(".info").each(function(){
            var activeLocations = $(this).find(".fa-location-arrow");
            if (activeLocations.hasClass("selectedFlight")) {
                activeLocations.removeClass("selectedFlight");
            } 
        });
        $(this).toggleClass("selectedFlight");
    });


});