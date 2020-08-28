<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <!-- Animate JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>

    <title>Flight Tracker</title>

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <!--<link rel="apple-touch-icon" href="icon.png"> -->
    <!-- Place favicon.ico in the root directory -->

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/public/assets/css/style.css">
</head>
<body <?php if($page == 'home') {echo "class=home"; } ?> >
    
    <!-- nav -->
    <nav class="container">
        <div class="logo">
            <a href="/"><img src="/public/assets/images/logo.png" alt=""></a>
        </div>
        <div class="menu-toggle"> 
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </div>
        <div class="nav-menu">
            <ul class="nav-links">
                <li class="nav-link <?php if($page == 'home') { echo 'active';} ?>"><a href="/">Home</a></li>
                <li class="nav-link <?php if($page == 'airlines') { echo 'active';} ?>"><a href="/airlineops/allAirlines">Airlines</a></li>
                <li class="nav-link <?php if($page == 'airports') { echo 'active';} ?>"><a href="/airportops/allAirports">Airports</a></li> 
                <li class="nav-link <?php if($page == 'flights') { echo 'active';} ?>"><a href="/flightops/listFlights">Flights</a></li>
            </ul>
        </div>
    </nav>