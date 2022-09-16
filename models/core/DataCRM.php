<?php

    /**
     *  Clase que me permite obtener los datos de la API de DataCRM
     *  
     *  @author Jose Luis González Salinas
     */
    class DataCRM
    {

        /**
         *  Atributo **cURL** que me permite comunicarme con la API de DataCRM
         */
        private $curl;
        /**
         *  Atributo **token** el cual almacenará el token obtenido de la API de DataCRM 
         *  para después iniciar sesión
         */
        private $token;
        /**
         *  Atributo **sessionID** el cual guardará el nombre de la sessión obtenida una vez
         *  se inicie sesión en la API
         */
        private $sessionID;

        /**
         *  Se inicializan todos los atributos de la clase DataCRM.
         *  - cURL      = CurlHandle()
         *  - token     = null
         *  - sessionID = null
         */
        function __construct()
        {
            $this->curl = curl_init();
            $this->token = null;
            $this->sessionID = null;
        }

        /**
         *  Método que me permite obtener el token generado a través de la API y asignarselo
         *  al atributo **token**. Este método retornará un dato booleano, **true** si se logró
         *  obtener el **token** de la API, **false** si no se logró obtener el **token**.
         * 
         *  @return bool
         */
        function getToken()
        {
            if ($this->token == null) {
                curl_setopt_array($this->curl, array(
                    CURLOPT_URL => 'https://develop.datacrm.la/anieto/anietopruebatecnica/webservice.php?operation=getchallenge&username=prueba',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                ));

                $this->token = json_decode(curl_exec($this->curl), true)["result"]["token"];

                curl_close($this->curl);
            }

            if ($this->token != null) {
                return true;
            }

            return false;
        }

        /**
         *  Método que me permite iniciar sesión en la API de DataCRM mediante la encriptación con
         *  MD5 del **token** y la clave de acceso. Este método retornará un dato booleano,
         *  **true** si se logra iniciar sesión, **false** si no se logró iniciar sesión.
         * 
         *  @return bool
         */
        function login()
        {
            $this->token = md5($this->token . "3DlKwKDMqPsiiK0B");

            curl_setopt_array($this->curl, array(
                CURLOPT_URL => 'https://develop.datacrm.la/anieto/anietopruebatecnica/webservice.php',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'operation=login&username=prueba&accessKey=' . $this->token,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                ),
            ));

            $response = json_decode(curl_exec($this->curl), true);

            $this->sessionID = $response["result"]["sessionName"];

            curl_close($this->curl);

            if ($this->sessionID != null) {
                return true;
            }

            return false;
        }

        /**
         *  Método que me permite obtener los **contacts** de la API de DataCRM. Este método
         *  retornará un **array** con la respuesta dada por la API.
         * 
         *  @param string $session Nombre de la sesión creada en la API de DataCRM
         *  @return array $response Respuesta obtenida de la API de DataCRM
         */
        function data()
        {
            curl_setopt_array($this->curl, array(
                CURLOPT_URL => 'https://develop.datacrm.la/anieto/anietopruebatecnica/webservice.php?operation=query&sessionName=' . $this->sessionID . '&query=select%20*%20from%20Contacts;',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = json_decode(curl_exec($this->curl), true);

            return $response;
        }
    }

?>