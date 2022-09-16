<?php

    class Login extends SessionController {

        function __construct()
        {
            parent::__construct();
        }

        function render(){
            $this->view->render("login/index");
        }

        function auth(){
            $sessionData = $this->model->signIn();
            error_log("USANDO EL METODO AUTH");

            if ($sessionData != null){
                error_log("INICIO SESION CON EXITO");
                $this->initialize($sessionData);
            } else {
                $this->redirect("", []);
            }
        }

        function leave(){
            $this->logout();
        }
        
    }

?>