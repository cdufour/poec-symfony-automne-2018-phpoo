<?php

require 'classes/Team.php';

// récupération des valeurs postées
$name             = $_POST['name'];
$yearFoundation   = $_POST['yearFoundation'];
$league           = $_POST['league'];
$stadium          = $_POST['stadium'];
$coach            = $_POST['coach'];

// instantiation de la classe Team et passage de valeurs
// au constructeur
$team = new Team(
  $name, $yearFoundation, $league, $stadium, $coach);

if ($team->save()) {
  // echo 'Enregisrement réussi';
  header('location:public/index.php'); // redirection
} else {
  echo 'L\'enregisrement a échoué';
}






//
?>
