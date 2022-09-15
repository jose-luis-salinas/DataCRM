<?php

    class Home extends SessionController {

        public function __construct()
        {
            parent::__construct();

            error_log("Es::Construct => Inicio de ES");
        }

        function render(){
            $this->view->render("Home/index", [
            ]);
            
            error_log("Home::render => Carga el index de Home");
        }

        function data(){
            echo json_encode($this->model->getData());
        }

    }

?>