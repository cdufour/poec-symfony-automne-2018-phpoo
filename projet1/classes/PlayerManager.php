<?php
require_once 'Player.php';
require_once 'TeamManager.php';

class PlayerManager {
  private $pdo;

  function __construct() {
    try {
      $this->pdo = new PDO('mysql:host=localhost;dbname=poo', 'root', 'root');
    } catch(PDOException $e) {
      var_dump($e);
    }
  }

  public function findAll() {
    $query = $this->pdo->prepare(
      'SELECT * FROM player');

    $query->execute();
    $rows = $query->fetchAll(PDO::FETCH_OBJ);

    $tm = new TeamManager();
    $players = [];
    foreach($rows as $row) {
      $team = $tm->findById($row->team_id);

      $player = new Player($row->name, $row->position, $team);
      $player->setId($row->id);
      $players[] = $player;
    }

    return $players;
  }

  public function findById($id) {
    $query = $this->pdo->prepare(
      'SELECT * FROM player WHERE id = :id');
    $query->execute([':id' => $id]);
    $row = $query->fetch(PDO::FETCH_OBJ);

    if (!$row) return null;

    $player = new Player($row->name, $row->position);
    $player->setId($row->id);
    return $player;
  }

  public function deleteById($id) {
    $query = $this->pdo->prepare(
      'DELETE FROM player WHERE id = :id');
    return $query->execute([':id' => $id]);
  }

}

?>
