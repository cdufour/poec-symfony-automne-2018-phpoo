<?php
require_once '../classes/TeamManager.php';
$tm = new TeamManager();
$id = intval($_GET['id']);
$team = $tm->findById($id);

if ($team->delete()) {
  header('location:index.php');
} else {
  echo '<div>La suppresion a échoué</div>';
}

?>
