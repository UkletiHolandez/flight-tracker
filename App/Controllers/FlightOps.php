<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Flight;

    class FlightOps extends \Core\Controller {

        protected static $flights = null;

        public function __construct() {
            if (!self::$flights) {
                self::$flights = new Flight();
            }
        }

        public function listFlights() {
            $results = self::$flights->getActiveFlights();
            View::render('Flight/list.php', ['results' => $results]);
        }

    }