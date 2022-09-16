<?php

    /**
     *  Clase que me permitirá crear la aplicación web de acuerdo a un controlador usado,
     *  cargará el modelo y la vista del mismo
     * 
     *  @author Jose Luis González Salinas
     */
    class App {

        /**
         *  Constructor de la aplicación que me permitirá crear la **App** de acuerdo a
         *  la configuración del controlador obtenido, creará un objeto del controlador y a
         *  través de éste cargará el modelo y renderizará la vista.
         */
        function __construct()
        {
            $url = isset($_GET["url"]) ? $_GET["url"] : null;
            $url = isset($url) ? rtrim($url, "/") : "";
            $url = explode("/", $url);

            if (empty($url[0])){
                $controller = 'controllers/Home.php';
                require $controller;

                $controller = new Home();
                $controller->getModel("Home");
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
                    }
                } else {
                    $controller->render();
                }
            }
        }
    }

?>