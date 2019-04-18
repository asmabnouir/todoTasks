<?php
/*
    ./noyau/constantes.php
    Constantes du framework
 */

  $local_path = str_replace(basename($_SERVER['SCRIPT_NAME']) , '', $_SERVER['SCRIPT_NAME']);

  define('ROOT', 'http://'
                . $_SERVER['HTTP_HOST']
                . $local_path);

  define('ROOT_ADMIN', 'http://'
                            . $_SERVER['HTTP_HOST']
                            . str_replace(PUBLIC_PATH, ADMIN_PATH, $local_path));
