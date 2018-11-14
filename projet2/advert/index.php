<?php
include_once '../includes/settings.inc.php';
include_once PATH_BASE . 'includes/checkaccess.inc.php';
include_once PATH_BASE . 'includes/db.inc.php';

if (isset($_POST['submit'])) {
  $pdo = connectToDb();

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
    echo 'Annonce enregistrée';
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
        <input type="submit" name="submit">
      </form>

    <?php else: ?>

      <p>ACCESS INTERDIT</p>

    <?php endif; ?>


   </body>
 </html>
