<?php

require_once '../classes/Team.php';
require_once '../classes/TeamManager.php';

$t = new Team('PSG',1970,'Ligue 1','Parc des Princes','Tomas Tuchel');

// var_dump($t);
// echo $t->getStadium();
// $t->setCoach('Thierry Henry');
// echo $t->getCoach();
// var_dump($t->save())

$tm = new TeamManager();
var_dump($tm->findById(4));

?>
