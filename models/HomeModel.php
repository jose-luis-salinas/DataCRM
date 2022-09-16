<?php

    require_once "core/DataCRM.php";

    class HomeModel {

        function __construct()
        {
            
        }

        function getData(){
            $dataCRM = new DataCRM();
            $result = null;

            if ($dataCRM->getToken()){
                if ($dataCRM->login()) {
                    $result = json_decode($dataCRM->serialize(), true);
                }
            }

            $contacts = $dataCRM->data($result["sessionID"])["result"];
            echo json_encode($contacts);
        }

    }

?>