<?php

try {
  $pdo = new PDO('mysql:host=localhost;dbname=projet3', 'root', 'root');
} catch (PDOException $e) {
  var_dump($e);
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Projet 5</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <h1>Projet 5</h1>

    <form>
      <input
        id="category"
        type="text"
        placeholder="Saisir une catégorie">
    </form>

    <ul id="suggestions">

    </ul>

    <section id="proverbs"></section>

    <script src="js/app.js"></script>
  </body>
</html>
