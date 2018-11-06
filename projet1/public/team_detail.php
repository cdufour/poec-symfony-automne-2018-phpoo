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

    <h2>Enregistrement d'un joueur</h2>
    <form id="playerForm">
      <input id="name" type="text" placeholder="Nom">
      <select id="position">
        <option>Gardien</option>
        <option>Défenseur</option>
        <option>Milieu</option>
        <option>Attaquant</option>
      </select>
      <input id="submit" type="submit" value="Enregistrer">
    </form>

    <script src="js/app.js"></script>
  </body>
</html>
