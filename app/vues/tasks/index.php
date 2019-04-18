<?php
  /*
      ./app/vues.tasks/index.php
      Variables disponibles :
          - $tasks ARRAY(ARRAY(id, content, finished, created_at, updated_at))
   */
?>
<header class="header">
  <h1>A faire</h1>
  <input class="new-todo" id ="new_todo" placeholder="Qu'est-ce qui doit être fait?">
</header>
<ul class="todo-list">
  <?php foreach ($tasks as $task): ?>
    <?php include '../app/vues/tasks/task.php'; ?>
  <?php endforeach; ?>
</ul>
<footer class="footer">
  <span class="todo-count">
    <strong><?php echo $nbreTasks; ?></strong>  restantes
  </span>
  <ul class="filters">
    <li><a class="all" href="#/all" >Toutes</a></li>
    <li><a class="active" href="#/active">En cours</a></li>
    <li><a class="completed" href="#/completed">Terminées</a></li>
  </ul>
  <button class="clear-completed">
    Supprimer les terminées
  </button>
</footer>
