<?php

namespace Core;

    class Error {

        /*
            Error handler:    Convert all errors to Exceptions by throwing an ErrorException
            @param $errno:    error_level
            @param $errmsg:   error_message
            @param $errfile:  error_file
            @param $linenum:  error_line
            @param $vars:     error_context   
            @return void
        */
        public static function errorHandler($errNo, $errMsg, $errFile, $errLineNum, $vars) {
            $arrError = array(
                $errNo, $errMsg, $errFile, $errLineNum, $vars
            );
            // raise exception
        }

        /*
            Exception Handler: 
            @param $ex
                @method getMessage
                @method getCode
                @method getFile
                @method getLine
                @method getTrace
                @method getTraceAsString

        */

        public static function exceptionHandler($ex) {
            $code = $ex->getCode();
            if ($code != 404) {
                $code = 500;
            }
            http_response_code($code);

            if (\App\Config::LOG_ERRORS_ON_SCREEN) {
                echo "<h1>Fatal Error</h1>";
                echo "<p>Uncaught exception: '" . get_class($ex) . "'</p>";
                echo "<p>Message: '" . $ex->getMessage() . "'</p>";
                echo "<p>Stack Trace:<pre>:" . $ex->getTraceAsString() . "</pre></p>";
                echo "<p>Thrown in '" . $ex->getFile() . "' on line " . $ex->getLine() . "</p>";
            } else {
                $log = dirname(__DIR__) . '//logs//' . date('Y-m-d') . '.log';
                ini_set('error_log', $log);

                $message = "\r\nUncaught exception: '" . get_class($ex) . "'";
                $message .= " with message '" . $ex->getMessage() . "'";
                $message .= "\r\nStack trace: " . $ex->getTraceAsString();
                $message .= "\r\nThrown in '" . $ex->getFile() . "' on line " . $ex->getLine();
                $message .= "\n*****************************************************************************************\n";
                
                error_log($message);
                View::render("$code.php");
            }            
        }

    }