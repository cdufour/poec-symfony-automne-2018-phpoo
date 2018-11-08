<?php
require_once '../classes/TeamManager.php';
$id = intval($_GET['id']);
$tm = new TeamManager();
$team = $tm->findById($id);

if (isset($_POST['submit'])) {
  // l'utilisateur a cliqué sur le submit, une reqûete POST
  // a été envoyée au serveur
  // mise à jour de l'équipe
  $team->setName($_POST['name']);
  $team->setYearFoundation(intval($_POST['yearFoundation']));
  $team->setLeague($_POST['league']);
  $team->setStadium($_POST['stadium']);
  $team->setCoach($_POST['coach']);

  if($team->update()) {
    // succès => redirection vers page d'accueil
    header('location:index.php');
  } else {
    echo '<div>La mise à jour a échoué</div>';
  }
}
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
    <h2>Mise à jour de: <?php echo $team->getName(); ?></h2>
    <form method="post">
      <input type="text"
        name="name" placeholder="Nom"
        value="<?php echo $team->getName(); ?>">
      <input type="text"
        name="yearFoundation" placeholder="Année de création"
        value="<?php echo $team->getYearFoundation(); ?>">
      <input type="text"
        name="league" placeholder="Championnat"
        value="<?php echo $team->getLeague(); ?>">
      <input type="text"
        name="stadium" placeholder="Nom du stade"
        value="<?php echo $team->getStadium(); ?>">
      <input type="text"
        name="coach" placeholder="Entraîneur"
        value="<?php echo $team->getCoach(); ?>">
      <input type="submit" name="submit" value="Mettre à jour">
    </form>


  </body>
</html>
