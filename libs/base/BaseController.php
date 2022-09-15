<?php

    class BaseController {

        function __construct()
        {
            $this->view = new View();
        }

        function getModel($pModel){
            $url = 'models/' . ucfirst($pModel) . 'Model.php';
            error_log("BaseController::getModel => URL : " . $url);
            
            if (file_exists($url)){
                require_once $url;

                $modelName = $pModel . "Model";
                $this->model = new $modelName();
            }
        }

        function existPost($pParams){
            foreach($pParams as $param){
                if (!isset($_POST[$param])){
                    error_log("BaseController::existPost => No existe el parametro: " . $param);
                    return false;
                }
            }

            return true;
        }

        function existGet($pParams){
            foreach($pParams as $param){
                if (!isset($_GET[$param])){
                    error_log("BaseController::existPost => No existe el parametro: " . $param);
                    return false;
                }
            }

            return true;
        }

        function getPost($pName){
            return $_POST[$pName];
        }

        function getGet($pName){
            return $_GET[$pName];
        }

        function redirect($pRoute,  $pMsg){
            $data = [];
            $params = "";

            foreach($pMsg as $key => $msg){
                array_push($data, $key . "=" . $msg);
            }

            $params = join("&", $data);

            if ($params != ""){
                $params = "?" . $params;
            }

            header("Location: " . URL . $pRoute . $params);
        }
    }

?>