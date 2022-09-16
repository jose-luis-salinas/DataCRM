<?php

    /**
     *  Clase que me permite obtener la **vista** del controlador
     * 
     *  @author Jose Luis González Salinas
     */
    class View {

        function __construct()
        {
            
        }

        /**
         *  Método que me permite cargar la **vista** que usará el controlador
         *  del directorio **\views**
         * 
         *  @param string $nombre Nombre de la vista que se va a cargar
         *  @param array $data Parametros que se pasarán a la vista (si es necesario)
         *  @return void
         */
        function render($nombre, $data = []){
            $this->d = $data;

            require dirname(__DIR__) . '/views/' . $nombre . ".php";
        }
    }

?>