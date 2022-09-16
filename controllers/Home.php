<?php

    class Home extends BaseController {

        public function __construct()
        {
            parent::__construct();

            //$this->sessionName = $this->getSessionData();

            error_log("Home::Construct => Inicio de Home");
        }

        function render(){
            $this->view->render("home/index", [
            ]);
            
            error_log("Home::render => Carga el index de Home");
        }

        function data(){
            $this->model->getData();
        }

    }

?>