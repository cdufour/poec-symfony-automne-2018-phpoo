<?php
require_once 'includes/settings.inc.php';
require_once PATH_BASE . 'includes/checkaccess.inc.php';
require_once PATH_BASE . 'includes/db.inc.php';

$pdo = connectToDb();
$query = $pdo->prepare(
  'SELECT * FROM advert ORDER BY id DESC');
$query->execute();
$adverts = $query->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Projet 2: Accueil</title>
    <?php include_once PATH_BASE . 'includes/css.inc.php'; ?>
  </head>
  <body>
    <header>
      <?php include PATH_BASE . 'includes/menu.inc.php'; ?>
    </header>
    <h1>Projet 2: Accueil</h1>

    <?php foreach($adverts as $advert): ?>
      <article class="advert">
        <h3><?php echo $advert->title; ?></h3>
        <div>
          <?php echo $advert->body; ?>
        </div>
      </article>
    <?php endforeach; ?>

  </body>
</html>
