<?php
session_start();
require_once '../classes/Access.php';
include_once '../includes/settings.inc.php';
$ok = false;

if (isset($_SESSION['user'])) {
  $access = new Access();
  $role = $access->getRoleByPseudo($_SESSION['user']);

  if ($role != false && $role->role == 'admin') {
    $ok = true;
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
       <?php include '../includes/menu.inc.php'; ?>
     </header>

    <?php if($ok): ?>

      <h2>Ajout d'une annonce</h2>

    <?php else: ?>

      <p>ACCESS INTERDIT</p>

    <?php endif; ?>


   </body>
 </html>
