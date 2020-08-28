<?php  
    if (!empty($airlines)) {
        $arrDate = array();
        foreach ($airlines as $airline) {
            $date = date('d-m-Y', strtotime($airline['arr_sch_time']));
            array_push($arrDate, $airline['date']);
        }
        $arrDistDate = array_unique($arrDate);
?>
        <h3 id="airline-flight-list"></h3>
        <?php
        foreach($arrDistDate as $distDate) {
            echo "<h4 class='date-groupping'>" . $distDate. "</h4>"; ?>
            <table class="table" id="table-airlines">
                <thead class="table-header">
                    <tr class="th-custom">
                        <th class="ten">Flight</th>
                        <th class="twenty-five">Origin</th>
                        <th class="twenty-five">Destination</th>
                        <th class="ten arrival-time">Arrival Time</th>
                        <th class="ten delay">Delay (min)</th>
                        <th class="ten">Status</th>
                    </tr>
                </thead> 
                <tbody>
            <?php
            foreach ($airlines as $airline) { 
                $date = date('d-m-Y', strtotime($airline['arr_sch_time']));
                $time = date('H:i', strtotime($airline['arr_sch_time'])); 
                if ($distDate === $airline['date']) { ?>
                    <tr>
                        <td data-column="Flight:"><?php echo $airline['flight_iata_number'];?></td>
                        <td data-column="Origin:"><?php echo $airline['origin'];?></td>
                        <td data-column="Destination:"><?php echo $airline['destination'];?></td>
                        <td class="arrival-time" data-column="Arrival Time:"><?php echo $airline['time']; ?></td>
                        <td class="delay" data-column="Delay (min):"><?php echo $airline['arr_delay'];?></td>
                        <td data-column="Status:"><?php echo $airline['flight_status'];?></td>
                    </tr>
                <?php }
            } ?>
                </tbody>
                </table>
        <?php } 
    } ?> 