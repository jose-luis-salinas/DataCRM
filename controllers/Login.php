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

            if ($sessionData != null){
                $this->initialize($sessionData);
            } else {
                $this->redirect("", "");
            }
        }

        function leave(){
            $this->logout();
        }
        
    }

?>