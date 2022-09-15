<?php

    class View {

        function __construct()
        {
            
        }

        function render($pNombre, $pData = []){
            $this->d = $pData;

            require dirname(__DIR__, 2) . '/views/' . $pNombre . ".php";
        }
    }

?>