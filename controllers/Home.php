<?php

    /**
     *  Controlador que se encarga de cargar la vista de "Home", donde se
     *  podrá visualizar la información obtenida de la API de DataCRM y cargada en una 
     *  tabla de la vista. Esta clase a su vez hereda de la clase padre BaseController.
     * 
     *  @author Jose Luis González Salinas
     */
    class Home extends BaseController {

        /**
         *  Constructor que permite inicializar la clase **BaseController**
         *  de la que hereda
         */
        public function __construct()
        {
            parent::__construct();
        }

        /**
         *  Función que se encarga de cargar la vista por defecto del controlador a través
         *  del método render de la clase heredada.
         * 
         *  @return void
         */
        function render(){
            $this->view->render("home/index", [
            ]);
        }

        /**
         *  Función que se encarga de obtener los datos de la API de DataCRM.
         * 
         *  @return void
         */
        function data(){
            $this->model->getData();
        }

    }

?>