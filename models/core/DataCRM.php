<?php

class DataCRM
{

    private $curl;
    private $token;
    private $sessionID;

    function __construct()
    {
        $this->curl = curl_init();
        $this->token = null;
        $this->sessionID = null;
    }

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

    function data($session)
    {
        curl_setopt_array($this->curl, array(
            CURLOPT_URL => 'https://develop.datacrm.la/anieto/anietopruebatecnica/webservice.php?operation=query&sessionName=' . $session . '&query=select%20*%20from%20Contacts;',
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

    function serialize()
    {
        return json_encode(array(
            "token" => $this->token,
            "sessionID" => $this->sessionID
        ));
    }
}
