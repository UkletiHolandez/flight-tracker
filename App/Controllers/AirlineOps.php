<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Airline;

    class AirlineOps extends \Core\Controller {

        protected static $airlines = null;

        public function __construct() {
            if (!self::$airlines) {
                self::$airlines = new Airline();
            }
        }

        public function allAirlines() {
            $results = self::$airlines->getAirlines();
            View::render('Airline/list.php', ['results' => $results]);
        }

        public function flightsByAirline() {            
            $selectedAirline = $_POST['airline'];
            $flightsAirline = self::$airlines->getFlightsByAirline($selectedAirline);

            View::render('Airline/flights_airline.php', ['airlines' => $flightsAirline]);
        }

    }