<?php
/*
    ./app/controleurs/pagesControleur.php
    Contrôleur des pages
 */
    namespace App\Controleurs\Tasks;
    use App\Modeles\Task;

    function indexAction(\PDO $connexion, array $params = []){
      include_once '../app/modeles/tasksModele.php';
      $tasks = Task\findAll($connexion, $params);
      $nbreTasks = Task\findRestCount($connexion);

      GLOBAL $title, $content1;
      $title = TITRE_DEFAUT;
      ob_start();
        include '../app/vues/tasks/index.php';
      $content1 = ob_get_clean();
    }

    function addAction(\PDO $connexion, string $content){
      include_once '../app/modeles/tasksModele.php';
      $id = intval(Task\insert($connexion, $content));
      $task = Task\findOneById($connexion, $id);

      //je charge la vue task
      include '../app/vues/tasks/task.php';
    }

    function editAction(\PDO $connexion, array $data){
      include_once '../app/modeles/tasksModele.php';
      echo Task\updateOneById($connexion, $data);

    }

    function toggleFinishAction(\PDO $connexion, array $data){
      include_once '../app/modeles/tasksModele.php';
      echo Task\updateFinishedOneById($connexion, $data);

    }

    function deleteAction(\PDO $connexion , int $id){
      include_once '../app/modeles/tasksModele.php';
      echo Task\deleteOneById($connexion, $id);
    }

    function deleteAllAction(\PDO $connexion ){
      include_once '../app/modeles/tasksModele.php';
      echo Task\deleteAllFinished($connexion);
    }
