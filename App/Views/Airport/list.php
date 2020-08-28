<?php 
    $page = "airports";
    require "./../App/Views/Templates/header.php";    
?>

    <!-- airline selection-->
    <section class="airports container">
        <div class="box-wrapper">
            <div class="box select-airport">
                <label for="airports">Select an airport:</label>
                <select name="airports" id="airports" class="select-box-airport">
                <option value="" selected disabled hidden>Choose here</option>
                <?php
                    foreach ($results as $data) { ?>
                        <option value="<?php echo $data['airport_iata_code']; ?>">
                            <?php echo $data['city_airport']; ?>
                        </option>
                    <?php }
                ?>
                </select>
            </div>
            <div class="box select-direction">
                <div class="box radio-arr">
                    <input type="radio" id="arr" name="flight-direction" value="arrivals" checked>
                    <label for="arr">Arrivals</label><br>
                </div>
                <div class="box radio-dep">
                    <input type="radio" id="dep" name="flight-direction" value="departures" disabled>
                    <label for="dep">Departures</label><br>
                </div>
            </div>
        </div>
        <div class="box-wrapper">
            <div class="box table-airports-data" id="table-airports-data"></div>
        </div>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>    
    <script src="/public/assets/js/main.js"></script>
</body>
</html>

