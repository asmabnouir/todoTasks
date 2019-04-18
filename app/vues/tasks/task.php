<?php
  /*
      ./app/vues/tasks/task.php
      Variables disponibles :
          - $task ARRAY(ARRAY(id, content, finished, created_at, updated_at))
   */
?>
<li class="todo <?php echo ($task['finished']==1)?'completed':''; ?>" data-id="<?php echo $task['id']; ?>">
  <div class="view">
    <input class="toggle" type="checkbox" <?php echo ($task['finished']==1)?'checked="checked"':''; ?>>
    <label><?php echo $task['content'] ?></label>
    <button class="destroy"></button>
  </div>
</li>
