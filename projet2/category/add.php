<?php
//file: category/add.php
include_once '../includes/settings.inc.php';
include_once PATH_BASE . 'includes/checkaccess.inc.php';
include_once PATH_BASE . 'includes/db.inc.php';

if (isset($_POST['submit'])) {
  $pdo = connectToDb();

  $query = $pdo->prepare(
    'INSERT INTO category (name) VALUES (:name)');

  $result = $query->execute([':name' => $_POST['name']]);

  if ($result) {
    echo 'Categorie enregistrée';
  } else {
    echo 'Echec';
  }

}

?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Projet 2: Ajout d'une catégorie</title>
     <?php include PATH_BASE . 'includes/css.inc.php'; ?>
   </head>
   <body>
     <header>
       <?php include PATH_BASE . 'includes/menu.inc.php'; ?>
     </header>

    <?php if ($isUserAdmin): ?>

      <h2>Ajout d'une catégorie</h2>

      <form method="post">
        <input type="text" placeholder="Nom" name="name">
        <input type="submit" name="submit">
      </form>

    <?php else: ?>

      <p>ACCESS INTERDIT</p>

    <?php endif; ?>
   </body>
 </html>
