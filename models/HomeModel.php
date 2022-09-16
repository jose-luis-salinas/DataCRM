<?php

    require_once "core/DataCRM.php";

    class HomeModel {

        function __construct()
        {
            
        }

        function getData($sessionName){
            $dataCRM = new DataCRM();
            $contacts = $dataCRM->data($sessionName)["result"];
            echo json_encode($contacts);
        }

    }

?>