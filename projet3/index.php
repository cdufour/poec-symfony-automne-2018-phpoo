<?php
$search = null;
$category_id = null;

try {
  $pdo = new PDO('mysql:host=localhost;dbname=projet3', 'root', 'root');
} catch (PDOException $e) {
  var_dump($e);
}

// récupération des catégories triées par nom croissant
$query = $pdo->prepare('SELECT id, name FROM category ORDER BY name ASC');
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_OBJ);

// si l'utilisateur soumet le formulaire
if (isset($_GET['submit'])) {
  $search = $_GET['search'];

  // la clause LIKE permet de faire une recherche full text
  // $query = $pdo->prepare(
  //   'SELECT * FROM proverb WHERE body LIKE :search');
  // $query->execute([':search' => '%' . $search . '%']);
  // $rows = $query->fetchAll(PDO::FETCH_OBJ);

  // récupérer les proverbes liés à la catégorie sélectionnée
  $category_id = intval($_GET['category']);

  $q = '';
  if ($category_id === 0) {
    // l'utilisateur n'a choisi aucune catégorie,
    // on ne filtre pas par catégorie
    $q = 'SELECT * FROM proverb WHERE body LIKE :search';
    $query = $pdo->prepare($q);
    $query->execute([':search' => '%' . $search . '%']);

  } else {
    $q = 'SELECT proverb.id AS proverb_id, body
      FROM proverb_category JOIN proverb
      ON proverb.id = proverb_category.proverb_id
      WHERE category_id = :category_id
      AND body LIKE :search';
    $query = $pdo->prepare($q);
    $query->execute(
      [
        ':category_id' => $category_id,
        ':search' => '%' . $search . '%'
      ]
    );
  } // fin if/else

  $rows = $query->fetchAll(PDO::FETCH_OBJ);

}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Projet 3</title>
  </head>
  <body>
    <h1>Projet 3</h1>
    <form>
      <?php if(isset($_GET['submit'])): ?>
        <input
          value="<?php echo $_GET['search']; ?>"
          type="text" name="search" placeholder="mots-clés">
      <?php else: ?>
        <input type="text" name="search" placeholder="mots-clés">
      <?php endif; ?>
      <select name="category">
        <option value="0">Choisir une catégorie</option>
        <?php foreach($categories as $cat): ?>
            <option
              <?php if($cat->id == $category_id) echo 'selected'; ?>
              value="<?php echo $cat->id; ?>">
              <?php echo ucfirst($cat->name); ?>
            </option>
        <?php endforeach; ?>
      </select>
      <input type="submit" name="submit">
    </form>

    <?php if(isset($rows) && sizeof($rows) > 0): ?>
      <h2>
        <strong><?php echo sizeof($rows); ?></strong>
        proverbe(s) trouvé(s) pour:
        <strong><?php echo $search ?></strong>
      </h2>
      <?php foreach($rows as $row): ?>
        <article><?php echo $row->body; ?></article>
      <?php endforeach; ?>
    <?php else: ?>
      <h2>
        Aucun proverbe trouvé pour:
        <strong><?php echo $search ?></strong>
      </h2>
    <?php endif; ?>
  </body>
</html>
