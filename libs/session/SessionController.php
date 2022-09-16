<?php

    require_once 'libs/session/Session.php';

    class SessionController extends BaseController {

        private $session;
        private $sites;

        public function __construct()
        {
            parent::__construct();
            
            $this->init();
        }

        function init(){
            $this->session = new Session();

            $json = $this->getJSONFile();

            $this->sites = $json["sites"];
            $this->defaultSites = $json["default-sites"];

            $this->validateSession();
        }

        private function getJSONFile(){
            $s = file_get_contents('config/access.json');
            $json = json_decode($s, true);

            return $json;
        }

        private function validateSession(){
            if ($this->existsSession()){
                $role = $this->getSessionData()["role"];

                if ($this->isPublic()){
                    $this->redirectDefaultSiteByRole($role);
                } else {
                    if ($this->isAuthorized($role)){

                    } else {
                        $this->redirectDefaultSiteByRole($role);
                    }
                }
            } else {
                if ($this->isPublic()){

                } else {
                    $this->redirect("", []);
                }
            }
        }

        private function existsSession(){
            if (!$this->session->exists()){
                return false;
            }

            if ($this->session->getCurrentUser() == null){
                return false;
            }

            return true;
        }

        public function getSessionData(){
            return json_decode($this->session->getCurrentUser(), true);
        }

        private function isPublic(){
            $currentURL = $this->getCurrentPage();
            $currentURL = preg_replace("/\?.*/", "", $currentURL);

            for($i = 0; $i < sizeof($this->sites); $i++){
                if ($currentURL == $this->sites[$i]["site"] && $this->sites[$i]["access"] == "public"){
                    return true;
                }
            }

            return false;
        }

        private function getCurrentPage(){
            $actualLink = trim("$_SERVER[REQUEST_URI]");
            $url = explode("/", $actualLink);

            return $url[0];
        }

        private function isAuthorized($pRole){
            $currentURL = $this->getCurrentPage();
            $currentURL = preg_replace("/\?.*/", "", $currentURL);

            for($i = 0; $i < sizeof($this->sites); $i++){
                if ($currentURL == $this->sites[$i]["site"] && $this->sites[$i]["role"] == $pRole){
                    return true;
                }
            }

            return false;
        }

        private function redirectDefaultSiteByRole($role){
            $url = "";

            for($i = 0; $i < sizeof($this->sites); $i++){
                if ($this->sites[$i]["role"] == $role){
                    $url = "/" . $this->sites[$i]["site"];
                    break;
                }
            }

            header("Location: " . URL . $url);
        }

        function initialize($data){
            $this->session->setCurrentUser($data);
            $this->authorizedAccess(json_decode($data, true)["role"]);
        }

        function authorizedAccess($pRole){
            switch($pRole){
                case "Admin":
                    $this->redirect($this->defaultSites["Admin"], []); //! FALTA 
                    break;
            }
        }

        function logout(){
            $this->session->closeSession();
            $this->redirect("", "");
        }
    }
