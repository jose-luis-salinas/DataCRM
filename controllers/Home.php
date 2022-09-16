<?php

    class Home extends SessionController {

        private $sessionName;

        public function __construct()
        {
            parent::__construct();

            $this->sessionName = $this->getSessionData();

            error_log("Es::Construct => Inicio de ES");
        }

        function render(){
            $this->view->render("Home/index", [
            ]);
            
            error_log("Home::render => Carga el index de Home");
        }

        function data(){
            $this->model->getData($this->sessionName["sessionID"]);
        }

    }

?>