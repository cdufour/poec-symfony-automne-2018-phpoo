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
$teamsSameLeague =
  $tm->findByLeague($team->getLeague());

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
    <?php
      if ($team->getLogo()) {
        echo '<img class="logo" src="img/logo/'. $team->getLogo() .'">';
      }
    ?>
    <p>Entraîneur:
      <strong><?php echo $team->getCoach(); ?></strong>
    </p>
    <p>Championnat:
      <strong><?php echo $team->getLeague(); ?></strong>
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

    <div class="container">
      <div class="row">
        <div class="col-md-9">

          <!-- tableau des joueurs -->
          <?php if(sizeof($team->getPlayers()) > 0): ?>
          <table id="playersTable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Nom</th>
                <th>Poste</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($team->getPlayers() as $player): ?>
              <tr>
                <td><?php echo $player->getName(); ?></td>
                <td><?php echo $player->getPosition(); ?></td>
                <td>
                  <button
                    data-id="<?php echo $player->getId(); ?>"
                    class="btn btn-warning btn-sm btnEdit">Editer</button>
                  <button
                    data-id="<?php echo $player->getId(); ?>"
                    class="btn btn-danger btn-sm btnDelete">Supprimer</button>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>


        </div>
        <div class="col-md-3">
          <h4>Dans le même championnat</h4>
          <ul>
            <?php
              foreach($teamsSameLeague as $t) {
                if ($t->getId() != $team->getId()) {
                  echo '<li><a href="team_detail.php?id='. $t->getId() .'">'. $t->getName() .'</a></li>';
                }
              }
            ?>
          </ul>
        </div>
      </div>
    </div>


    <script src="js/app.js"></script>
  </body>
</html>
