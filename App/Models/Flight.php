<?php

    namespace App\Models;
    use PDO;

    class Flight extends __Database {
        
        /* ---------------------------------------------------------------------------------------------
         *   Retrieve list of all currently active flights
         *   Data returned by this method are displayed in a list on Flights page
         * ---------------------------------------------------------------------------------------------
        */
        public function getActiveFlights() {
            $queryInfo = array(
                "attributes" => array(
                    "a.flight_iata_number",
                    "b.flight_number",
                    "a.dep_iata_code",
                    "d.city_name as origin",
                    "date_format(b.dep_sch_time, '%d-%m-%Y') as 'dep_date'",
                    "date_format(b.dep_sch_time, '%H:%i') as 'dep_time'",
                    "a.arr_iata_code",
                    "e.city_name as destination",
                    "c.airline_name as operator",
                    "b.arr_sch_time",
                    "date_format(b.arr_sch_time, '%d-%m-%Y') as 'arr_date'",
                    "date_format(b.arr_sch_time, '%H:%i') as 'arr_time'",
                    "a.geo_altitude",
                    "a.geo_direction",
                    "a.geo_latitude",
                    "a.geo_longitude",
                    "b.arr_delay",
                    "a.flight_status"
                ),
                "tableName" => "flight_active a",
                "joinTable" => "LEFT JOIN airport_timetable b",
                "joinField" => "ON a.flight_iata_number = b.flight_iata_number LEFT JOIN airline c ON a.airline_icao_code = c.airline_icao_code LEFT JOIN v_airport_city d ON a.dep_iata_code = d.airport_iata_code LEFT JOIN v_airport_city e
                ON a.arr_iata_code = e.airport_iata_code",
                "conditions" => array(
                    "a.flight_status = 'en-route' AND",
                    "c.airline_status = 'active'" 
                ),
                "order" => "9, 10, b.flight_number, a.flight_iata_number" 
            );
            
            $query = $this->query($queryInfo['attributes'], $queryInfo['tableName'], $queryInfo['joinTable'], $queryInfo['joinField'], $queryInfo['conditions'], null, $queryInfo['order']);

            return $query;
        }

    }