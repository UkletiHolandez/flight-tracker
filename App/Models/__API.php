<?php

    namespace App\Models;

    trait __API {

        private $ch;
        private $apiData;
        private $apiResponseCode;
        private $response = [];
        protected $totalData = 0;

        /* ------------------------------------------------------------------------------------------------------
         *   This Trait is not in use in current project. 
         *   It was in use at the project setup to collect flight API data and store in database for later use
         * ------------------------------------------------------------------------------------------------------
        */

        private function getApiData($endpoint, $url, $queryString) {

            // create curl instance
            $this->ch = curl_init(sprintf('%s?%s', $url, $queryString));

            // set options
            curl_setopt_array($this->ch, 
                array(
                    //CURLOPT_URL => $url,
                    //CURLOPT_HEADER => false,
                    CURLOPT_RETURNTRANSFER => 1,
                    // SSL certificate problem: unable to get local issuer certificate
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_SSL_VERIFYPEER => false
                )
            );
            
            // execute request and place results in variable $response
            $this->apiData = curl_exec($this->ch);

            $this->apiResponseCode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

            if (curl_errno($this->ch)) {
                $this->response['code'] = $this->apiResponseCode;
                $this->response[$endpoint] = curl_error($this->ch);
            } else {
                if ($this->apiResponseCode == "200") {
                    // terminate curl instance
                    curl_close($this->ch);
                    $this->apiData = json_decode($this->apiData, true);
                    $this->response['code'] = $this->apiResponseCode;
                    $this->response[$endpoint] = $this->apiData;
                    $this->totalData = $this->apiData['pagination']['total'];
                }
                
            }

            return $this->response;

        }

    }