<?php
/*
    ./app/modeles/tasksModele.php
    Modèle des tasks
 */
    namespace App\Modeles\Task;

/**
 * [findOneById Détails d'un enregistrement]
 * @param  PDO    $connexion
 * @param  int    $id        [id de l'enregistrement]
 * @return array  [ARRAY()]
 */
function findOneById(\PDO $connexion, int $id){
  $sql = "SELECT *
          FROM tasks
          WHERE id = :id;";
  $rs = $connexion->prepare($sql);
  $rs->bindValue(':id', $id, \PDO::PARAM_INT);
  $rs->execute();
  return $rs->fetch(\PDO::FETCH_ASSOC);
}

/**
 * [findAll Liste des enregistrements]
 * @param  PDO    $connexion
 * @param  array  $params    [Paramètres de la requête [orderBy, orderSens, limit, offset]]
 * @return array  [ARRAY(ARRAY())]
 */
function findAll(\PDO $connexion, array $params = []){
  $params_default = [
    'orderBy'   => 'id',
    'orderSens' => 'ASC',
    'limit'     => null,
    'offset'    => 0
  ];
  $params = array_merge($params_default, $params);

  $orderBy   = htmlentities($params['orderBy']);
  $orderSens = htmlentities($params['orderSens']);

  $sql = "SELECT *
          FROM tasks
          ORDER BY $orderBy $orderSens ";
  $sql .= ($params['limit'] !== null)?" LIMIT :limit OFFSET :offset ;":' ';
  $sql .= ";";

  $rs = $connexion->prepare($sql);
  if ($params['limit'] !== null):
    $rs->bindvalue(':limit', $params['limit'], \PDO::PARAM_INT);
    $rs->bindvalue(':offset', $params['offset'], \PDO::PARAM_INT);
  endif;

  $rs->execute();
  return $rs->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * [findFinishedCount Nombre de tâches terminées]
 * @param  PDO    $connexion
 * @return int    [Nombre de tâches terminées]
 */
function findRestCount(\PDO $connexion){
  $sql = "SELECT id
          FROM tasks
          WHERE finished = 0;";
  $rs = $connexion->query($sql);
  return count($rs->fetchAll(\PDO::FETCH_ASSOC));
}

/**
 * [insert Ajout d'un enregistrement]
 * @param  PDO     $connexion
 * @param  string  $content   [description]
 * @return int     [id de l'enregistrement ajouté]
 */
function insert(\PDO $connexion, string $content){
  $sql = "INSERT INTO tasks
          SET content = :content,
              created_at = NOW();";
  $rs = $connexion->prepare($sql);
  $rs->bindValue(':content', $content, \PDO::PARAM_STR);
  $rs->execute();
  return $connexion->lastInsertId();
}

/**
 * [updateOneById Modification d'un enregistrement]
 * @param  PDO    $connexion
 * @param  array  $data   [Données de l'enregistrement [content, id]]
 * @return int            [0/1]
 */
function updateOneById(\PDO $connexion, array $data = null){
  $sql = "UPDATE tasks
          SET content = :content,
              updated_at = NOW()
          WHERE id = :id;";
  $rs = $connexion->prepare($sql);
  $rs->bindValue(':content', $data['content'], \PDO::PARAM_STR);
  $rs->bindValue(':id', $data['id'], \PDO::PARAM_INT);
  return intval($rs->execute());
}

/**
 * [updateFinishedOneById Finir ou non un enregistrement ]
 * @param  PDO    $connexion
 * @param  array $data    [finished, id]
 * @return int            [0/1]
 */
function updateFinishedOneById(\PDO $connexion, array $data = null){
  $sql = "UPDATE tasks
          SET finished = :finished,
              updated_at = NOW()
          WHERE id = :id;";
  $rs = $connexion->prepare($sql);
  $rs->bindValue(':finished', $data['finished'], \PDO::PARAM_INT);
  $rs->bindValue(':id', $data['id'], \PDO::PARAM_INT);
  return intval($rs->execute());
}

/**
 * [deleteOneById Suppression d'un enregistrement]
 * @param  PDO    $connexion
 * @param  int    $id  [id de l'enregistrement à supprimer]
 * @return int    [0/1]
 */
function deleteOneById(\PDO $connexion, int $id){
  $sql = "DELETE FROM tasks
          WHERE id = :id;";
  $rs = $connexion->prepare($sql);
  $rs->bindValue(':id', $id, \PDO::PARAM_INT);
  return intval($rs->execute());
}

function deleteAllFinished(\PDO $connexion){
  $sql = "DELETE FROM tasks
          WHERE finished = 1;";
          $rs = $connexion->prepare($sql);
          return intval($rs->execute());
}
