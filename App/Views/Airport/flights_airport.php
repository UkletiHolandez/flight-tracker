<?php  
    if (!empty($airports)) { 
        $arrDate = array();
        foreach ($airports as $airline) {
            $date = date('d-m-Y', strtotime($airline['arr_sch_time']));
            array_push($arrDate, $airline['date']);
        }
        $arrDistDate = array_unique($arrDate);
?>
        <h3 id="airport-flight-list"></h3>
        <?php
        foreach($arrDistDate as $distDate) {
            echo "<h4 class='date-groupping'>" . $distDate. "</h4>"; ?>
            <table class="table" id="table-airports">
                <thead class="table-header">
                    <tr class="th-custom">
                        <th class="ten">Flight</th>
                        <th class="twenty-five">Origin</th>
                        <th class="twenty-five">Operated By</th>
                        <th class="ten arrival-time">Arrival Time</th>
                        <th class="ten delay">Delay (min)</th>
                        <th class="ten">Status</th>
                    </tr>
                </thead>
                <tbody>
            <?php
            foreach ($airports as $airport) { 
                if ($distDate === $airport['date']) { ?>
                    <tr>
                        <td data-column="Flight:"><?php echo $airport['flight_iata_number'];?></td>
                        <td data-column="Origin:"><?php echo $airport['origin'];?></td>
                        <td data-column="Destination:"><?php echo $airport['operator'];?></td>
                        <td class="arrival-time" data-column="Arrival Time:"><?php echo $airport['time'];?></td>
                        <td class="text-center delay" data-column="Delay (min):"><?php echo $airport['arr_delay'];?></td>
                        <td data-column="Status:"><?php echo $airport['flight_status'];?></td>
                    </tr>
                <?php }
            } ?>
                </tbody>
                </table>
        <?php } 
    } ?> 