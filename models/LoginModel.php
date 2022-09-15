<?php

    require_once "core/DataCRM.php";

    class LoginModel {

        function __construct()
        {
            
        }

        function signIn(){
            $dataCRM = new DataCRM();

            if ($dataCRM->getToken()){
                if ($dataCRM->login()) {
                    return $dataCRM->serialize();
                }
            }
        }

    }

?>