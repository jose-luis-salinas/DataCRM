<?php

    class App {

        function __construct()
        {
            $url = isset($_GET["url"]) ? $_GET["url"] : null;
            $url = isset($url) ? rtrim($url, "/") : "";
            $url = explode("/", $url);

            if (empty($url[0])){
                error_log("App:Construct => No hay controlador especifico");
                
                $controller = 'controllers/Login.php';
                require $controller;

                $controller = new Login();
                $controller->getModel("Login");
                $controller->render();

                return false;
            }

            $controller = 'controllers/' . $url[0] . ".php";

            if (file_exists($controller)){
                require $controller;

                $controller = new $url[0];
                $controller->getModel($url[0]);

                if (isset($url[1])){
                    if (method_exists($controller, $url[1])){
                        if (isset($url[2])){
                            $nParam = count($url) - 2;
                            $params = [];

                            for($i = 0; $i < $nParam; $i++){
                                array_push($params, $url[$i+2]);
                            }

                            $controller->{$url[1]}($params);
                        } else {
                            $controller->{$url[1]}();
                        }
                    } else {
                        // require_once 'controllers/errores.php';
                        // $controller = new Errores();
                    }
                } else {
                    $controller->render();
                }
            } else {
                // require_once 'controllers/errores.php';
                // $controller = new Errores();
            }
        }
    }

?>