<?php
session_start();
include_once 'includes/settings.inc.php';
require_once 'includes/db.inc.php';

if (isset($_POST['submit'])) {
  $pdo = connectToDb();

  $query = $pdo->prepare(
    'SELECT * FROM user
      WHERE email = :email AND password = :password');

  $query->execute(
    [
      ':email' => $_POST['email'],
      ':password' => $_POST['password']
    ]
  );

  $user = $query->fetch(PDO::FETCH_OBJ);
  if ($user) {
    $_SESSION['user'] = $user->pseudo;
    $_SESSION['user_id'] = $user->id;
  }

}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Projet 2: Login</title>
  </head>
  <body>
    <header>
      <?php include 'includes/menu.inc.php'; ?>
    </header>

    <form method="post">
      <input type="email" placeholder="email" name="email">
      <input type="password" placeholder="password" name="password">
      <input type="submit" name="submit">
    </form>

  </body>
</html>
