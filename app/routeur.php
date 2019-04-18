<?php
/*
    ./app/routeur.php
    Routeur principal
    Il décide quelle action de quel contrôleur il faut lancer
 */

    if (isset($_GET['tasks'])):
      include_once '../app/routeurs/tasksRouteur.php';

    else:
      include_once '../app/controleurs/tasksControleur.php';
      \App\Controleurs\Tasks\indexAction($connexion, [
        'orderBy'   => 'created_at',
        'orderSens' => 'DESC'
      ]);
    endif;
