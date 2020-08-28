<?php 
    $page = "airlines";
    require "./../App/Views/Templates/header.php";    
?>

    <!-- airline selection-->
    <section class="airlines container">
        <div class="box-wrapper">
            <div class="box select-airlines">
                <label for="airlines">Select an airline:</label>
                <select name="airlines" id="airlines" class="select-box-airline">
                <option value="" selected disabled hidden>Choose here</option>
                <?php
                    foreach ($results as $data) { ?>
                        <option value="<?php echo $data['airline_icao_code']; ?>">
                            <?php echo $data['airlines']; ?>
                        </option>
                    <?php }
                ?>
                </select>
            </div>
        </div>
        <div class="box-wrapper">
            <div class="box table-airlines-data" id="table-airlines-data"></div>
        </div>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>    
    <script src="/public/assets/js/main.js"></script>
</body>
</html>

