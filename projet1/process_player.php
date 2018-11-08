<?php
require_once 'classes/Player.php';
require_once 'classes/TeamManager.php';

// Problème, $_POST est vide dans le cas d'une requête ajax
// solution: file_get_contents
// https://codepen.io/dericksozo/post/fetch-api-json-php

// file_get_contents renvoie le corps de la requête post
// dans notre exemple, une chaîne au format JSON
$request_body = file_get_contents('php://input');
$playerObj = json_decode($request_body); // renvoie
// un objet par défaut (renvoie tableau associatif si le deuxième
// argument de json_encode vaut true
// http://php.net/manual/fr/function.json-decode.php

$tm = new TeamManager();
$team = $tm->findById(intval($playerObj->team_id));

$player = new Player(
  $playerObj->name,
  $playerObj->position,
  $team
);

echo $player->save(); // renvoie l'id du joueur enregistré

?>
