<?php
include_once '../includes/settings.inc.php';
include_once PATH_BASE . 'includes/checkaccess.inc.php';
include_once PATH_BASE . 'includes/db.inc.php';

// ce fichier sera requis via ajax en GET

// mise à jour d'une annonce
// on augmente d'une unité l'indice sa popularité

$pdo = connectToDb();
$query = $pdo->prepare(
  'UPDATE advert
    SET popularity = popularity + 1
    WHERE id = :id');

$result = $query->execute([':id' => intval($_GET['id'])]);

echo ($result) ? 'ok' : 'error';


?>
