<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../classes/TeamManager.php';
$tm = new TeamManager();

// conversion en entier de la chaîne renvoyée par $_GET['id']
$id = intval($_GET['id']);
// $team = $tm->findById($id);
$team = $tm->findByIdJoin($id);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Equipe: <?php echo $team->getName() ?></title>
    <?php include 'css.inc.php' ?>
  </head>
  <body>
    <?php include 'menu.inc.php' ?>
    <h1>Equipe: <?php echo $team->getName() ?></h1>
    <p>Entraîneur:
      <strong><?php echo $team->getCoach(); ?></strong>
    </p>

    <h2>Enregistrement d'un joueur</h2>
    <form id="playerForm">
      <input id="team_id"
        type="hidden" value="<?php echo $team->getId() ?>">
      <input id="name" type="text" placeholder="Nom">
      <select id="position">
        <option>Gardien</option>
        <option>Défenseur</option>
        <option>Milieu</option>
        <option>Attaquant</option>
      </select>
      <input id="submit" type="submit" value="Enregistrer">
    </form>

    <!-- Affichage des joueurs -->
    <?php if(sizeof($team->getPlayers()) > 0): ?>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Poste</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($team->getPlayers() as $player): ?>
        <tr>
          <td><?php echo $player->getName(); ?></td>
          <td><?php echo $player->getPosition(); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>


    <script src="js/app.js"></script>
  </body>
</html>
