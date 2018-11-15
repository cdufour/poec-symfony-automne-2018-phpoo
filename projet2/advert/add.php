<?php
//file: advert/add.php
include_once '../includes/settings.inc.php';
include_once PATH_BASE . 'includes/checkaccess.inc.php';
include_once PATH_BASE . 'includes/db.inc.php';

// récupération des catégories pour alimenter
// le champ de sélection multiple du formulaire
$pdo = connectToDb();
$query = $pdo->prepare(
  'SELECT * FROM category ORDER BY name ASC');
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['submit'])) {

  // 1/ On enregistre l'annonce
  $query = $pdo->prepare(
    'INSERT INTO advert (title, body, location, user_id)
      VALUES (:title, :body, :location, :user_id)');

  $result = $query->execute([
    ':title' => $_POST['title'],
    ':body' => $_POST['body'],
    ':location' => $_POST['location'],
    ':user_id' => $_SESSION['user_id']
  ]);

  if ($result) {
    echo '<p>Annonce enregistrée</p>';

    // on récupére l'identifiant de l'annonce
    // venant d'être insérer en DB
    $advert_id = $pdo->lastInsertId();

    // 2/ traitement des catégories
    if (isset($_POST['categories'])) {
      foreach($_POST['categories'] as $category) {

        $query = $pdo->prepare(
          'INSERT INTO advert_category (advert_id, category_id)
            VALUES (:advert_id, :category_id)');

        $result = $query->execute([
          ':advert_id' => $advert_id,
          ':category_id' => intval($category)
        ]);

        if ($result) {
          echo '<p>Catégorie enregistré</p>';
        } else {
          echo '<p>Echec</p>';
        }
      }
    }

  } else {
    echo 'Echec';
  }



}

?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Project 2: Ajout d'une annonce</title>
     <?php include PATH_BASE . 'includes/css.inc.php'; ?>
   </head>
   <body>
     <header>
       <?php include PATH_BASE . 'includes/menu.inc.php'; ?>
     </header>

    <?php if($isUserAdmin): ?>

      <h2>Ajout d'une annonce</h2>

      <form method="post">
        <input type="text" placeholder="Titre" name="title">
        <div>
          <label for="body">Description</label>
          <textarea name="body" id="body"></textarea>
        </div>
        <div>
          <input type="text" name="location" placeholder="Lieu">
        </div>
        <div>
          <p>Catégories</p>
          <select name="categories[]" multiple>
            <?php
              foreach($categories as $category) {
                echo '<option value="'.$category->id.'">'.$category->name.'</option>';
              }
            ?>
          </select>
        </div>
        <input type="submit" name="submit">
      </form>

    <?php else: ?>

      <p>ACCESS INTERDIT</p>

    <?php endif; ?>


   </body>
 </html>
