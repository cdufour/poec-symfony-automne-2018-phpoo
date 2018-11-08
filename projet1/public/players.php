<?php
require_once '../classes/PlayerManager.php';
$pm = new PlayerManager();
$players = $pm->findAll();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php include 'css.inc.php' ?>
  </head>
  <body>
    <?php include 'menu.inc.php' ?>
    <h2>Liste des joueurs (<?php echo sizeof($players) ?>)</h2>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Poste</th>
          <th>Equipe</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($players as $player): ?>
        <tr>
          <td><?php echo $player->getName(); ?></td>
          <td><?php echo $player->getPosition(); ?></td>
          <td>
            <?php
              if ($player->getTeam() == null) {
                echo 'Sans équipe';
              } else {
                echo $player->getTeam()->getName();
              }
            ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  </body>
</html>
