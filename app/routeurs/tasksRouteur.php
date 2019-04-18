<?php
/*
    ./app/routeurs/tasksRouteur.php
    Routeur des Tasks
 */
include_once '../app/controleurs/tasksControleur.php';
use \App\Controleurs\Tasks;

  switch ($_GET['tasks']):
    case "add" :
    Tasks\addAction($connexion, $_POST['content']);
    break;
    case "delete" :
    Tasks\deleteAction($connexion, $_GET['id']);
    break;

    case "toggleFinish" :
    Tasks\toggleFinishAction($connexion,[
      'id'     => $_GET['id'],
      'finished'=> $_POST['finished']
    ]);
    break;

    case "edit" :
    Tasks\editAction($connexion,[
      'id'     => $_GET['id'],
      'content'=> $_POST['content']
    ]);
    break;

    case "deleteFinished" :
    Tasks\deleteAllAction($connexion);
    break;

  endswitch;
