<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Airport;

    class AirportOps extends \Core\Controller {

        protected static $airports = null;

        public function __construct() {
            if (!self::$airports) {
                self::$airports = new Airport();
            }
        }

        public function allAirports() {
            $results = self::$airports->getAirports();
            View::render('Airport/list.php', ['results' => $results]);
        }

        public function flightsByAirport() {
            $selectedAirport = $_POST['airport'];
            $flightsAirport = self::$airports->getFlightsByAirport($selectedAirport);

            View::render('Airport/flights_airport.php', ['airports' => $flightsAirport]);
        }

        

    }