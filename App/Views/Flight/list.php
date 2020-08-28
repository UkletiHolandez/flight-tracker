<?php 
    $page = "flights";
    require "./../App/Views/Templates/header.php";    
?>
    
    <!-- airline selection-->
    <section class="flights container">
        <div class="box-wrapper">
            <div class="box" id="content">
                <div class="flight-wrapper">
                    <?php foreach ($results as $flight) { ?>
                        <div class="flight">
                            <div class="flight-info" data-geo-alt="<?php echo($flight['geo_altitude']); ?>" data-geo-dir="<?php echo($flight['geo_direction']); ?>" data-geo-lat="<?php echo($flight['geo_latitude']); ?>" data-geo-lng="<?php echo($flight['geo_longitude']); ?>">
                                <div class="flight-number">
                                    <h2><?php echo($flight['flight_iata_number']); ?></h2>
                                    <h3><?php echo($flight['operator']); ?></h3>
                                </div>
                                <div class="info">
                                    <i class="fas fa-location-arrow"></i>
                                </div>
                            </div>
                            <div class="flight-plan">
                                <div class="box" id="origin">
                                    <span class="city"><?php echo($flight['origin']); ?></span>
                                    <span class="iata"><?php echo($flight['dep_iata_code']); ?></span>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-plane"></i>
                                </div>
                                <div class="box" id="dest">
                                    <span class="city"><?php echo($flight['destination']); ?></span>
                                    <span class="iata"><?php echo($flight['arr_iata_code']); ?></span>
                                </div>
                            </div>
                            <div class="flight-time">
                                <div class="box" id="dep-time">
                                    <span class="time">Departed:</span>
                                    <span class="act-time"><?php echo($flight['dep_time']); ?></span>
                                </div>
                                <div class="box" id="arr-time">
                                    <span class="time">Estimated:</span>
                                    <span class="sch-time"><?php echo($flight['arr_time']); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="box" id="map"></div>
        </div>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>   
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBM8cbv3ziyc_bPOvXwZKWmyrV6fvKfFA&callback=initMap&libraries=&v=weekly" defer></script> 
    <script src="/public/assets/js/map.js"></script>
    <script src="/public/assets/js/main.js"></script>
</body>
</html>

