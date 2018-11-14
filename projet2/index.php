<?php
session_start();
echo 'Salut ' . $_SESSION['user'];

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Projet 2</title>
  </head>
  <body>
    <header>
      <?php include 'includes/menu.inc.php'; ?>
    </header>
    <h1>Projet 2</h1>
    <p>Afficher liste des annonces ici...</p>

  </body>
</html>
