var map;
var marker;

function initMap() {
    var mapOptions = {
        center: {
            lat: 49.397,
            lng: 25.45
        },
        mapTypeId: 'hybrid',
        disableDefaultUI: true,
        zoom: 4
    }
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
}

function setMarker(lat, lng, dir, flightDetails) {
    // Remove previous Marker
    if (marker != null) {
        marker.setMap(null);
    }

    // Set Marker on Map
    var myLatLng = new google.maps.LatLng(lat, lng);
    
    // Re-center the map based on flight coordinates
    map.panTo(myLatLng);

    var plane = {
        path:
          "M510,255c0-20.4-17.85-38.25-38.25-38.25H331.5L204,12.75h-51l63.75,204H76.5l-38.25-51H0L25.5,255L0,344.25h38.25    l38.25-51h140.25l-63.75,204h51l127.5-204h140.25C492.15,293.25,510,275.4,510,255z",
        fillColor: "#fee12b",
        fillOpacity: 1,
        strokeColor: "#000",
        strokeWeight: 0.8,
        rotation: -90 + dir,
        scale: 0.04
    };

    marker = new google.maps.Marker({
        map: map,
        position: myLatLng,
        title: "Test Title",
        icon: plane
    });

    // Create and open InfoWindow
    var infoWindow = new google.maps.InfoWindow();
    infoWindow.setContent(
        "<div style = 'width:200px;min-height:40px'><p class = 'iwFlghtDet'>" + flightDetails['flightNumber'] + "</p><p class = 'iwFlghtDet'>" + flightDetails['flightIataCodeDep'] + ' - ' + flightDetails['flightIataCodeArr'] + "</p><p class = 'iwFlghtDet'>" + flightDetails['flightDepTime'] + ' - ' + flightDetails['flightArrTime'] + "</p></div>");
    infoWindow.open(map, marker);
}