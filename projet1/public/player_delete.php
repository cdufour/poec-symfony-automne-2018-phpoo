<?php
// *** traite la requête ajax de suppression d'un joueur ***
require_once '../classes/PlayerManager.php';

$id = intval($_GET['id']);
$pm = new PlayerManager();
echo $pm->deleteById($id);

?>
