<?php
require_once 'includes/settings.inc.php';
require_once PATH_BASE . 'includes/checkaccess.inc.php';
require_once PATH_BASE . 'includes/db.inc.php';

$pdo = connectToDb();
// $query = $pdo->prepare(
//   'SELECT * FROM advert ORDER BY id DESC');

$query = $pdo->prepare(
  'SELECT advert.id AS advert_id, advert.title, advert.body, category.name
    FROM advert
    LEFT JOIN advert_category
      ON advert_category.advert_id = advert.id
    LEFT JOIN category
      ON advert_category.category_id = category.id');

$query->execute();
$rows = $query->fetchAll(PDO::FETCH_OBJ);

$adverts = []; // longueur 0;
$previous_id = 0;

for ($i = 0; $i < sizeof($rows); $i++) {
  if ($previous_id != $rows[$i]->advert_id) {
    // la longueur de $adverts augmente d'une unité
    // un nouvel indice est créé
    $adverts[] = array(
      'advert' => $rows[$i],'categories' => []);

    if ($rows[$i]->name != null) {
        $lastIndex = sizeof($adverts) - 1;
        $adverts[$lastIndex]['categories'][] = $rows[$i]->name;
    }

  } else {
    // on est face à un doublon => catégorie à traiter
    // on ajoute le nom de la catégorie dans le tableau
    // imbriqué correspond à l'annonce dont on repère l'indice
    // dans la variable $lastIndex
    $lastIndex = sizeof($adverts) - 1;
    $adverts[$lastIndex]['categories'][] = $rows[$i]->name;
  }
  $previous_id = $rows[$i]->advert_id;
}


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

    <?php for($i = 0; $i < sizeof($adverts); $i++): ?>
      <article class="advert">
        <h3><?php echo $adverts[$i]['advert']->title; ?></h3>
        <div>
          <?php echo $adverts[$i]['advert']->body; ?>
        </div>
        <div>
          <span>Catégories: </span>
          <?php echo implode(', ', $adverts[$i]['categories']); ?>
        </div>
      </article>
    <?php endfor; ?>

  </body>
</html>
