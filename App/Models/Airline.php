<?php

    namespace App\Models;
    use PDO;
    use App\Config;

    class Airline extends __Database {
                
         /* ---------------------------------------------------------------------------------------------
         *   Retrieve list of active flights for all airlines 
         *   Data returned by this method are used in select box on Airlines page
         * ---------------------------------------------------------------------------------------------
        */
        public function getAirlines() {
            /* in queryInfo multidimensional array, create arrays for every query section as follows:
                "attributes" => array (...) -> enter comma separated list of fields you want to query. If using aggregate functions, enter the function. 
                Example: "field1", "field2", "sum(field3)",... 
                
                "tableName" => 'table'      -> enter the name of the table
                
                "conditions" => array (...) -> optional. default null. If required, enter in associative array form, similar as for the attributes. If there are more than one condition, add AND or OR at the end of previous condition
                Example: "field 1 > 300", "field2 =='Name'"    
            */

            $queryInfo = array(
                "attributes" => array(
                    "concat(airline_name, ' (', airline_icao_code, ')') AS airlines, airline_icao_code"
                ),
                "tableName" => "airline",
                "joinTable" => null,
                "joinField" => null,
                "conditions" => array(
                    "airline_icao_code in (select distinct(airline_icao_code) from flights.flight_active) AND",
                    "airline_status = 'active'"
                ),
                "order" => "1" 
            );
            
            $query = $this->query($queryInfo['attributes'], $queryInfo['tableName'], $queryInfo['joinTable'], $queryInfo['joinField'], $queryInfo['conditions'], null, $queryInfo['order']);

            return $query;
        }

        /* -----------------------------------------------------------------------------------------------------------------------------------------
         *   Retrieve list of active flights for the airline provided as parameter to this method 
         *   Data returned by this method are used in table of arrival flights on Airlines page (after an airport is selected from drop-down menu)
         * -----------------------------------------------------------------------------------------------------------------------------------------
        */
        public function getFlightsByAirline($airline) {
            $queryInfo = array(
                "attributes" => array(
                    "a.flight_iata_number",
                    "b.flight_number",
                    "concat(d.city_name, ' (', a.dep_iata_code, ')') as origin",
                    "concat(c.city_name, ' (', a.arr_iata_code, ')') as destination",
                    "date_format(b.arr_sch_time, '%d-%m-%Y') as 'date'",
                    "date_format(b.arr_sch_time, '%H:%i') as 'time'",
                    "b.arr_delay",
                    "a.flight_status"
                ),
                "tableName" => "flight_active a",
                "joinTable" => "left join airport_timetable b",
                "joinField" => "on a.flight_iata_number = b.flight_iata_number left join v_airport_city c ON a.arr_iata_code = c. airport_iata_code left join v_airport_city d ON a.dep_iata_code = d.airport_iata_code",
                "conditions" => array(
                    "a.airline_icao_code = '$airline'" 
                ),
                "order" => "5, 6, b.flight_number, a.flight_iata_number" 
            );
            
            $query = $this->query($queryInfo['attributes'], $queryInfo['tableName'], $queryInfo['joinTable'], $queryInfo['joinField'], $queryInfo['conditions'], null, $queryInfo['order']);

            return $query;
        }

    }