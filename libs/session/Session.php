<?php

    class Session {
        
        private $sessionName = "dataCRM_User";

        public function __construct()
        {
            if (session_status() == PHP_SESSION_NONE){
                session_start();
            }
        }

        public function setCurrentUser($account){
            $_SESSION[$this->sessionName] = $account;
        }

        public function getCurrentUser(){
            if ($this->exists()){
                return $_SESSION[$this->sessionName];
            }
        }

        public function closeSession(){
            session_unset();
            session_destroy();
        }

        public function exists(){
            return isset($_SESSION[$this->sessionName]);
        }
    }

?>