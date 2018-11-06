<?php
require_once '../classes/TeamManager.php';
$tm = new TeamManager();

// conversion en entier de la chaîne renvoyée par $_GET['id']
$id = intval($_GET['id']);
$team = $tm->findById($id);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Equipe: <?php echo $team->getName() ?></title>
  </head>
  <body>
    <h1>Equipe: <?php echo $team->getName() ?></h1>
    <p>Entraîneur:
      <strong><?php echo $team->getCoach(); ?></strong>
    </p>

  </body>
</html>
