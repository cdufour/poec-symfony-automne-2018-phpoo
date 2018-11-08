<?php
// *** traite la requête ajax de mise à jour d'un joueur ***

require_once '../classes/PlayerManager.php';

$request_body = file_get_contents('php://input');
$playerObj = json_decode($request_body);

$pm = new PlayerManager();
$player = $pm->findById(
  intval($playerObj->id)
);

// mise à jour de l'objet Player
$player->setName($playerObj->name);
$player->setPosition($playerObj->position);

echo $player->update();

?>
