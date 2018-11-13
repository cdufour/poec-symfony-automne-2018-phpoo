<?php

if (isset($_FILES['file'])) {
  // un fichier a été chargé sur le serveur

  $filename = $_FILES['file']['name'];

  $ok = move_uploaded_file(
    $_FILES['file']['tmp_name'], $filename);

  if ($ok) {
    echo '<p>Fichier chargé avec succès</p>';
    $f = fopen($filename, 'r');
    $str = '';

    while(!feof($f)) {
      $c = fgetc($f);
      $str .= $c;
    }

    fclose($f); // fermeture du fichier

    $lines = explode("\n", $str);
    foreach($lines as $i => $line) {
      if ($i != 0) {
        // l'indice O correspond à la ligne
        // d'entête du fichier (pas d'insertion en db)

        // $fields reçoit un tableau de trois éléments
        var_dump($fields);
        $fields = explode(",", $line);

        // on charge insertToDB d'enregistrer les données
        //insertToDB($fields);
      }
    }

  }
}

function insertToDB($fields) {

  try {
    $pdo = new PDO('mysql:host=localhost;dbname=projet6', 'root', 'root');;
  } catch (PDOException $e) {
    var_dump($e);
  }

  if ($fields[0] == "") {
    echo '<p>Ligne vide</p>';
    return;
  }

  $query = $pdo->prepare(
    'INSERT INTO student (lastname, firstname, cursus)
      VALUES (:lastname, :firstname, :cursus)');

  $ok = $query->execute([
    ':lastname' => $fields[0],
    ':firstname' => $fields[1],
    ':cursus' => $fields[2]
  ]);

  if ($ok) {
    echo '<p>' . $fields[0] . ' enregistré en DB</p>';
  } else {
    echo '<p>' . $fields[0] . ' n\' a pas pu être enregistré</p>';
  }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Projet 6: Process Students</title>
  </head>
  <body>
    <h1>Projet 6: Process Students</h1>
    <form method="post" enctype="multipart/form-data">
      <input type="file" name="file">
      <input type="submit">
    </form>
  </body>
</html>
