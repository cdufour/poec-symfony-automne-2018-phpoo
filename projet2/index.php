<?php
require_once 'includes/settings.inc.php';
require_once PATH_BASE . 'includes/checkaccess.inc.php';
require_once PATH_BASE . 'includes/db.inc.php';

$pdo = connectToDb();

// Récupération des catégories
$query = $pdo->prepare(
  'SELECT * FROM category ORDER BY name ASC');
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_OBJ);

// $query = $pdo->prepare(
//   'SELECT * FROM advert ORDER BY id DESC');

$sql = 'SELECT advert.id AS advert_id,
  advert.title,
  advert.body,
  category.name,
  category.id AS category_id
  FROM advert
  LEFT JOIN advert_category
    ON advert_category.advert_id = advert.id
  LEFT JOIN category
    ON advert_category.category_id = category.id';

// la variable $bindings sert à fournier une valeur
// au placeholder :search dans le cas d'une utilisation
// du moteur de recherche
$bindings = [];

// si l'utilisateur a utilisé le moteur de recherche
// on ajoute une clause WHERE à la requête SQL
// LIKE permet de faire une recherche full-text
// au niveau du titre de l'annonce

// filtre par mot-clé (recherche libre)
if (isset($_GET['search'])) {
  $sql .= ' WHERE advert.title LIKE :search';
  $bindings = [':search' => '%' . $_GET['search'] . '%'];
}

// filtre par catégorie
if (isset($_GET['categories'])) {

  // si le filtre par mot-clé déjà en place
  // on ajoute la condition par la clause AND
  // sinon on ajoute la condition par la clause WHERE
  // Rappel: une seule clause WHERE autorisée
  $sql .= (isset($_GET['search'])) ? ' AND ' : ' WHERE ';

  $in = implode(',', $_GET['categories']);
  $sql .= 'category.id IN ( '.$in.' )';
  // le binding PDO ne fonctionne pas avec la clause IN
  // solution: faire une concaténation dans la requête
  //$bindings = [':in' => $in];
}

$sql .= ' ORDER BY advert.id DESC';
$query = $pdo->prepare($sql);
$query->execute($bindings);
$rows = $query->fetchAll(PDO::FETCH_OBJ);

$adverts = []; // longueur 0;
$previous_id = 0;

// transformation des résultats SQL
// en une structure plus cohérente visant
// à éliminer les doublons (annonce multipliée
// par le nombre de catégories liées à cette annonce)
for ($i = 0; $i < sizeof($rows); $i++) {
  if ($previous_id != $rows[$i]->advert_id) {
    // la longueur de $adverts augmente d'une unité
    // un nouvel indice est créé
    $adverts[] = array(
      'advert' => $rows[$i],
      'categories' => [],
      'pictures' => []);

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
} // fin de la boucle for de transformation

// récupération des images associées aux annonces
// on utilise l'opérateur & pour accéder à advert
// par référence et non par copie, ce qui permet
// de modifier directement l'original
foreach($adverts as &$advert) {
  $advert_id = $advert['advert']->advert_id;
  $query = $pdo->prepare(
    'SELECT url FROM picture
     WHERE advert_id = :advert_id');

  $query->execute([':advert_id' => $advert_id]);
  $pictures = $query->fetchAll(PDO::FETCH_OBJ);

  // on complète le tableau $adverts
  if (sizeof($pictures) > 0) {
    $advert['pictures'] = $pictures;
  }
} // fin foreach

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

    <!-- Moteur de recherche -->
    <form>
      <input
        class="long"
        type="text"
        name="search"
        placeholder="Mots-clés, exemple: brosse à dent, yacht, ...">

      <!-- filtre par catégorie -->
      <button
        class="btn btn-primary btn-sm"
        id="moreFilters">Plus de filtres</button>
      <div id="filterCategories">
        <?php foreach($categories as $category): ?>
        <input
          type="checkbox"
          name="categories[]"
          value="<?php echo $category->id; ?>">
          <?php echo $category->name; ?><br>
        <?php endforeach; ?>
      </div>

      <div>
        <input type="submit">
      </div>
    </form>

    <!-- Affichage des annonces -->
    <?php for($i = 0; $i < sizeof($adverts); $i++): ?>
      <article class="advert">
        <h3><?php echo $adverts[$i]['advert']->title; ?></h3>
        <div>
          <?php echo $adverts[$i]['advert']->body; ?>
        </div>
        <div>
          <?php
          if (sizeof($adverts[$i]['pictures']) > 0) {
            foreach($adverts[$i]['pictures'] as $picture) {
              $url = URL_BASE . 'static/img/upload/' . $picture->url;
              echo '<a href="'.$url.'">';
              echo '<img class="xs" src="'.$url.'">';
              echo '</a>';
            }
          }
          ?>
        </div>
        <div>
          <span>Catégories: </span>
          <?php echo implode(', ', $adverts[$i]['categories']); ?>
        </div>
      </article>
    <?php endfor; ?>

    <script src="<?php echo URL_BASE . 'static/js/app.js' ?>"></script>
  </body>
</html>
