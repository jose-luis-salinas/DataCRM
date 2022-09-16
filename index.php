<?php

    /**
     *  Función que me permite capturar todos los errores PHP generados y me permite
     *  que errores notificar.
     */
    error_reporting(E_ALL);

    /**
     *  Función que me permite ignorar los errores que se puedan repetir.
     */
    ini_set("ignore_repeated_errors", TRUE);

    /**
     *  Función que me permite ocultar los errores generados que no se notificarán
     */
    ini_set("display_errors", FALSE);

    require 'libs/App.php';
    require 'libs/BaseController.php';
    require 'libs/View.php';

    require 'config/settings.php';

    $app = new App();

?>