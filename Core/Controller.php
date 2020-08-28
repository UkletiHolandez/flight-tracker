<?php

namespace Core;

    abstract class Controller {
        
        protected $arrGet = [];
        
        public function __construct() {

            if (!empty($_GET)) {
                foreach ($_GET as $k => $v) {
                    if ($v != null) {
                        $this->arrGet[$k] = $v;
                    }
                }
            }

        }
    }