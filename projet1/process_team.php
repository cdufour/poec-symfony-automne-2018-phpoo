<?php

require 'classes/Team.php';

// récupération des valeurs postées
$name             = $_POST['name'];
$yearFoundation   = $_POST['yearFoundation'];
$league           = $_POST['league'];
$stadium          = $_POST['stadium'];
$coach            = $_POST['coach'];

$logoName = $_FILES['logo']['name'];
$logoType = $_FILES['logo']['type'];
$logoSize = $_FILES['logo']['size'];

$format = substr($logoType, 0, 5);
$maxSize = 100000; // 100 ko

// explode renvoie un tableau de segments de chaîne
$logoNameExploded = explode('.', $logoName);
$lastIndex = sizeof($logoNameExploded) - 1;
$extension = $logoNameExploded[$lastIndex];
$fileName = strtolower($name) . '.' . $extension;
$destination = 'public/img/logo/' . $fileName;

if ($format == 'image' && $logoSize < $maxSize) {
  // OK, on peut déplacer le fichier
  move_uploaded_file($_FILES['logo']['tmp_name'], $destination);
} else {
  echo 'Format ou taille non accepté';
  $destination = null;
}

// instantiation de la classe Team et passage de valeurs
// au constructeur
$team = new Team(
  $name, $yearFoundation, $league, $stadium, $coach, $fileName);

if ($team->save()) {
  // echo 'Enregisrement réussi';
  header('location:public/index.php'); // redirection
} else {
  echo 'L\'enregisrement a échoué';
}






//
?>
