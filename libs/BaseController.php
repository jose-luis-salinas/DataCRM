<?php

    /**
     *  Clase que permite cargar la vista y el modelo del controlador que 
     *  herede de esta clase.
     * 
     *  @author Jose Luis González Salinas
     */
    class BaseController {

        /**
         *  Constructor que permite crear la vista del controlador.
         */
        function __construct()
        {
            $this->view = new View();
        }

        /**
         *  Método que me permite obtener el modelo del controlador
         * 
         *  @param string $model Nombre del modelo del controlador
         *  @return void
         */
        function getModel($model){
            $url = 'models/' . ucfirst($model) . 'Model.php';
            
            if (file_exists($url)){
                require_once $url;

                $modelName = $model . "Model";
                $this->model = new $modelName();
            }
        }
    }

?>