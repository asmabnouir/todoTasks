<?php
/*
    ./www/index.php
    Dispatcher central
 */

  require_once '../noyau/config.php';
  require_once '../app/routeur.php';

  if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
           && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    require_once '../app/vues/templates/defaut.php';
  }

  require_once '../noyau/connexion-fermer.php';
