<?php

    require_once "core/DataCRM.php";

    /**
     *  Modelo que se encarga de enviar los datos obtenidos de DataCRM hacia el HomeController,
     *  según lo requerido por el controlador.
     * 
     *  @author Jose Luis González Salinas
     */
    class HomeModel {

        function __construct()
        {
            
        }

        /**
         *  Función que se encarga de obtener el token de la API de DataCRM para luego autenticarse
         *  en una sesión y de esa manera obtener los **contacts** de la API. Este método retorna
         *  un objeto en formato JSON que es envíado a la petición realizada a través de jQuery.
         * 
         *  @return void
         */
        function getData(){
            $dataCRM = new DataCRM();
            $contacts = [];

            if ($dataCRM->getToken()){
                if ($dataCRM->login()) {
                    $contacts = $dataCRM->data()["result"];
                }
            }

            echo json_encode($contacts);
        }

    }

?>