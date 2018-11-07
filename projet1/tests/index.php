<?php

require_once '../classes/Team.php';
require_once '../classes/TeamManager.php';
require_once '../classes/Player.php';

$t = new Team('PSG',1970,'Ligue 1','Parc des Princes','Tomas Tuchel');
$t->setId(1);
// var_dump($t);
// echo $t->getStadium();
// $t->setCoach('Thierry Henry');
// echo $t->getCoach();
// var_dump($t->save())

// $tm = new TeamManager();
// var_dump($tm->findById(4));

// $player = new Player('Dybala', 'Milieu', $t);
// var_dump($player->save());

$message = array('message' => 'coucou', 'test' => true);
echo json_encode($message);

?>
