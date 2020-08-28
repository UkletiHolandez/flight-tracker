<?php

    namespace App\Models;
    use PDO;
    use App\Config;

    class Airport extends __Database {
        
         /* ---------------------------------------------------------------------------------------------
         *   Retrieve list of airports for currently active flights
         *   Data returned by this method are used in select box on Airports page
         * ---------------------------------------------------------------------------------------------
        */
        public function getAirports() {
            /* in queryInfo multidimensional array, create arrays for every query section as follows:
                "attributes" => array (...) -> enter comma separated list of fields you want to query.   If using aggregate functions, enter the function. 
                Example: "field1", "field2", "sum(field3)",... 
                
                "tableName" => 'table'      -> enter the name of the table
                
                "conditions" => array (...) -> optional. default null. If required, enter in associative array form, similar as for the attributes. If there are more than one condition, add AND or OR at the end of previous condition
                Example: "field 1 > 300", "field2 =='Name'"    
            */

            $queryInfo = array(
                "attributes" => array(
                    "concat(city_name, ' (', airport_name, ')') as 'city_airport', airport_iata_code"
                ),
                "tableName" => "v_airport_city",
                "joinTable" => null,
                "joinField" => null,
                "conditions" => array(
                    "airport_iata_code in (select distinct arr_iata_code from flight_active)"
                ),
                "order" => "1" 
            );
            
            $query = $this->query($queryInfo['attributes'], $queryInfo['tableName'], $queryInfo['joinTable'], $queryInfo['joinField'], $queryInfo['conditions'], null, $queryInfo['order']);

            return $query;
        }

        /* -------------------------------------------------------------------------------------------------------------------------------------------
         *   Retrieve list of (active) arrival flights for the airport provided as parameter to this method
         *   Data returned by this method are used in table of arrival flights on Airports page (after an airport is selected from drop-down menu)
         *   This version of application accepts only "arrival" flights as parameter
         * -------------------------------------------------------------------------------------------------------------------------------------------
        */
        public function getFlightsByAirport($airport, $direction = "arrival") {
            $queryInfo = array(
                "attributes" => array(
                    "a.flight_iata_number",
                    "b.flight_number",
                    "concat(d.city_name, ' (', a.dep_iata_code, ')') as origin",
                    "c.airline_name as operator",
                    "date_format(b.arr_sch_time, '%d-%m-%Y') as 'date'",
                    "date_format(b.arr_sch_time, '%H:%i') as 'time'",
                    "b.arr_delay",
                    "a.flight_status"
                ),
                "tableName" => "flight_active a",
                "joinTable" => "LEFT JOIN airport_timetable b",
                "joinField" => "ON a.flight_iata_number = b.flight_iata_number LEFT JOIN airline c ON a.airline_icao_code = c.airline_icao_code LEFT JOIN v_airport_city d ON a.dep_iata_code = d.airport_iata_code",
                "conditions" => array(
                    "a.arr_iata_code = '$airport' AND",
                    "c.airline_status = 'active'" 
                ),
                "order" => "5, 6, b.flight_number, a.flight_iata_number" 
            );
            
            $query = $this->query($queryInfo['attributes'], $queryInfo['tableName'], $queryInfo['joinTable'], $queryInfo['joinField'], $queryInfo['conditions'], null, $queryInfo['order']);

            return $query;
        }

    }