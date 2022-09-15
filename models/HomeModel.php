<?php

    require_once "core/DataCRM.php";

    class HomeModel {

        function __construct()
        {
            
        }

        function getData(){
            $dataCRM = new DataCRM();
        }

    }

?>