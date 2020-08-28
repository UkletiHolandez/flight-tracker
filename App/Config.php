<?php

namespace App;

    class Config {

        const DB_HOST = 'localhost';
        const DB_NAME = 'flights';
        const DB_SOURCE = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8';
        const DB_USER = 'root';
        const DB_PASSWORD = 'Admin123';

        /* not in use */
        const ASTACK_ACCESS_KEY = 'xxxx';
        const AEDGE_ACCESS_KEY = 'xxxx';

        const LOG_ERRORS_ON_SCREEN = false;

    }